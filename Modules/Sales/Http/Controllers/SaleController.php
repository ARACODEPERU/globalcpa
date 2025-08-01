<?php

namespace Modules\Sales\Http\Controllers;

use App\Models\Company;
use App\Models\Kardex;
use App\Models\KardexSize;
use App\Models\LocalSale;
use App\Models\PaymentMethod;
use App\Models\Person;
use App\Models\PettyCash;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDocument;
use App\Models\SaleProduct;
use App\Models\Serie;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use PDF;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = (new Sale())->newQuery();

        $search = request()->input('search');

        $isAdmin = Auth::user()->hasRole('admin');

        $sales = $sales->join('people', 'client_id', 'people.id')
            ->leftJoin('sale_documents', 'sale_documents.sale_id', 'sales.id')
            ->leftJoin('series', 'sale_documents.serie_id', 'series.id')
            ->select(
                'sales.id',
                'people.full_name',
                'total',
                'advancement',
                'total_discount',
                'payments',
                DB::raw("DATE_FORMAT(sales.created_at, '%Y-%m-%d') AS fecha"),
                'sales.local_id',
                'sales.status',
                'series.description AS serie',
                'sale_documents.number',
                DB::raw("(SELECT CONCAT(invoice_serie,'-',LPAD(invoice_correlative, 8, '0')) FROM sale_documents WHERE sale_documents.sale_id=sales.id AND invoice_serie IS NOT NULL) AS name_document"),
                DB::raw("(SELECT COUNT(sale_id) FROM sale_documents WHERE sale_documents.sale_id=sales.id) AS have_document")
            )
            ->where('physical', 1)
            ->when(!$isAdmin, function ($q) use ($search) {
                return $q->where('sales.user_id', Auth::id());
            })
            ->when($search, function ($q) use ($search) {
                return $q->whereRaw('CONCAT(series.description,"-",sale_documents.number) = ?', [$search])
                    ->orWhere('people.full_name', 'like', '%' . $search . '%');
            })
            ->orderBy('sales.created_at', 'DESC')
            ->paginate(10)
            ->onEachSide(2);

        return Inertia::render('Sales::Sales/List', [
            'sales' => $sales,
            'filters' => request()->all('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payments = PaymentMethod::all();
        $client = Person::find(1);
        $documentTypes = DB::table('identity_document_type')->get();
        $sizes = (new Product)->getUniqueSizes();

        return Inertia::render('Sales::Sales/Create', [
            'payments'      => $payments,
            'client'        => $client,
            'documentTypes' => $documentTypes,
            'sizeslist'         => $sizes
        ]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'total' => 'required|numeric|min:0|not_in:0',
                'payments.*.type' => 'required',
                'payments.*.amount' => 'required|numeric|min:0|not_in:0|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/',
                'client.id' => 'required',
                'sale_date' => 'required'
            ],
            [
                'payments.*.type.required' => 'Seleccione un tipo de pago',
                'payments.*.amount.required' => 'Ingrese monto',
            ]
        );
        //dd($request->all());
        try {
            $res = DB::transaction(function () use ($request) {


                $local_id = Auth::user()->local_id;
                $serie = Serie::where('document_type_id', '5')
                    ->where('local_id', $local_id)
                    ->first();

                $petty_cash = PettyCash::firstOrCreate([
                    'user_id' => Auth::id(),
                    'state' => 1,
                    'local_sale_id' => $local_id
                ], [
                    'date_opening' => Carbon::now()->format('Y-m-d'),
                    'time_opening' => date('H:i:s'),
                    'income' => 0
                ]);

                $serie_id = $serie->id;

                $sale = Sale::create([
                    'sale_date' => $request->get('sale_date'),
                    'user_id' => Auth::id(),
                    'client_id' => $request->get('client')['id'],
                    'local_id' => $local_id,
                    'total' => $request->get('total'),
                    'advancement' => $request->get('total'),
                    'total_discount' => 0,
                    'payments' => json_encode($request->get('payments')),
                    'petty_cash_id' => $petty_cash->id,
                    'physical' => 1
                ]);

                $document = SaleDocument::create([
                    'sale_id'   => $sale->id,
                    'serie_id'  => $serie_id,
                    'number'    => str_pad($serie->number, 9, '0', STR_PAD_LEFT),
                    'overall_total'     => $request->get('total'),
                    'user_id'  => Auth::id(),
                    'invoice_type_doc' => '80',
                    'invoice_serie' => $serie->description,
                    'invoice_correlative' => $serie->number
                ]);

                $serie->increment('number', 1);

                $products = $request->get('products');

                foreach ($products as $produc) {
                    SaleProduct::create([
                        'sale_id' => $sale->id,
                        'product_id' => $produc['id'],
                        'product' => json_encode(Product::find($produc['id'])),
                        'saleProduct' => json_encode($produc),
                        //'size'      => $produc['size'],
                        'price' => $produc['price'],
                        'discount' => $produc['discount'],
                        'quantity' => $produc['quantity'],
                        'total' => $produc['total']
                    ]);

                    $product = Product::find($produc['id']);


                    if ($product->is_product) {

                        $k = Kardex::create([
                            'date_of_issue' => Carbon::now()->format('Y-m-d'),
                            'motion' => 'sale',
                            'product_id' => $produc['id'],
                            'local_id' => $local_id,
                            'quantity' => - ($produc['quantity']),
                            'document_id' => $document->id,
                            'document_entity' => SaleDocument::class,
                            'description' => 'Venta'
                        ]);



                        if ($product->presentations) {
                            KardexSize::create([
                                'kardex_id' => $k->id,
                                'product_id' => $produc['id'],
                                'local_id' => $local_id,
                                'size'      => $produc['size'],
                                'quantity'  => (-$produc['quantity'])
                            ]);
                            $tallas = $product->sizes;
                            $n_tallas = [];
                            foreach (json_decode($tallas, true) as $k => $talla) {
                                if ($talla['size'] == $produc['size']) {
                                    $n_tallas[$k] = array(
                                        'size' => $talla['size'],
                                        'quantity' => ($talla['quantity'] - $produc['quantity'])
                                    );
                                } else {
                                    $n_tallas[$k] = array(
                                        'size' => $talla['size'],
                                        'quantity' => $talla['quantity']
                                    );
                                }
                            }
                            $product->update([
                                'sizes' => json_encode($n_tallas)
                            ]);
                        }

                        Product::find($produc['id'])->decrement('stock', $produc['quantity']);
                    }
                }
                return $sale;
            });

            return response()->json($res);
        } catch (\Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function destroy(Sale $sale)
    {
        try {
            $res = DB::transaction(function () use ($sale) {

                $sale->update(['status' => false]);

                // Busca el SaleDocument asociado a la venta
                $document = SaleDocument::where('sale_id', $sale->id)->first();

                // Verifica si se encontró el documento antes de intentar actualizarlo
                if ($document) {
                    $document->update([
                        'status' => 3
                    ]);
                } else {
                    // Opcional: Manejar el caso donde no se encontró el documento
                    // Por ejemplo, loguear un error, emitir una advertencia, o lanzar una excepción.
                    // Esto es útil para depurar o entender por qué falta el documento.
                    Log::warning("No se encontró SaleDocument para la venta con ID: " . $sale->id . ". No se pudo actualizar el estado.");
                    // O si es un error crítico:
                    // throw new \Exception("SaleDocument no encontrado para la venta ID: " . $sale->id);
                }

                $products = SaleProduct::where('sale_id', $sale->id)->get();

                foreach ($products as $item) {
                    if($item->entity_name_product == Product::class){
                        if (json_decode($item->product)->is_product == 1) {
                            $k = Kardex::create([
                                'date_of_issue' => Carbon::now()->format('Y-m-d'),
                                'motion' => 'sale',
                                'product_id' => $item->product_id,
                                'local_id' => $sale->local_id,
                                'quantity' => $item->quantity,
                                'document_id' => $document->id,
                                'document_entity' => SaleDocument::class,
                                'description' => 'Anulacion de Venta'
                            ]);

                            $product = Product::find($item->product_id);

                            if ($product->presentations) {

                                KardexSize::create([
                                    'kardex_id' => $k->id,
                                    'product_id' => $item->product_id,
                                    'local_id' => $sale->local_id,
                                    'size'      => json_decode($item->saleProduct)->size,
                                    'quantity'  => $item->quantity
                                ]);


                                $tallas = json_decode($product->sizes, true);
                                $n_tallas = [];
                                foreach ($tallas as &$size) {
                                    // Si el tamaño es igual a 22
                                    if ($size["size"] == json_decode($item->saleProduct)->size) {

                                        // Obtiene la cantidad actual
                                        $currentQuantity = intval($size["quantity"]); // Convierte a entero

                                        // Suma 1 a la cantidad actual
                                        $newQuantity = $currentQuantity + $item->quantity;

                                        // Actualiza la cantidad
                                        $size["quantity"] = $newQuantity;
                                    }
                                }

                                $n_tallas = $tallas;


                                $product->update([
                                    'sizes' => json_encode($n_tallas)
                                ]);
                            }
                            //Product::find($produc->product_id)->increment('stock', $produc->quantity);
                        }
                    }
                }
                return $sale;
            });

            return response()->json([
                'message' => 'Venta Anulado con éxito.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function ticketPdf($id)
    {
        $sale = Sale::find($id);
        $document = SaleDocument::join('series', 'serie_id', 'series.id')
            ->select(
                'series.description',
                'sale_documents.created_at',
                'sale_documents.number'
            )
            ->where('sale_documents.sale_id', $sale->id)
            ->first();
        $local = LocalSale::find($sale->local_id);
        $products = SaleProduct::where('sale_id', $sale->id)->get();
        $company = Company::first();
        $seller = User::find($sale->user_id);
        $payments = PaymentMethod::all();

        $data = [
            'local'     => $local,
            'sale'      => $sale,
            'products'  => $products,
            'document'  => $document,
            'company'   => $company,
            'seller'    => $seller,
            'payments'  => $payments
        ];

        $file = public_path('ticket/') . $seller->id . '-ticket.pdf';
        $pdf = PDF::loadView('sales::sales.ticket_pdf', $data);
        $pdf->setPaper(array(0, 0, 273, 500), 'portrait');
        $pdf->save($file);

        return response()->download($file);
    }

    public function printA4Pdf($id)
    {
        $sale = Sale::find($id);
        $document = SaleDocument::join('series', 'serie_id', 'series.id')
            ->select(
                'series.description',
                'sale_documents.created_at',
                'sale_documents.number'
            )
            ->where('sale_documents.sale_id', $sale->id)
            ->first();
        $local = LocalSale::find($sale->local_id);
        $products = SaleProduct::where('sale_id', $sale->id)->get();
        $company = Company::first();
        $seller = User::find($sale->user_id);
        $client = Person::find($sale->client_id);

        $data = [
            'local'     => $local,
            'sale'      => $sale,
            'products'  => $products,
            'document'  => $document,
            'company'   => $company,
            'seller'    => $seller,
            'client'    => $client
        ];

        //return view('sales::sales.A4_pdf', $data);

        $file = public_path('ticket/') . $seller->id . '-A4.pdf';
        $pdf = PDF::loadView('sales::sales.A4_pdf', $data);
        $pdf->setPaper('a4', 'portrait');
        $pdf->save($file);

        return response()->download($file);
    }

    public function printSalesDay($date)
    {
        $header = [
            'user_name'     => Auth::user()->name,
            'date'          => $date,
            'local_name'    => LocalSale::find(Auth::user()->local_id)->description
        ];

        $payments = PaymentMethod::all();

        $sales = SaleProduct::join('sales', 'sale_products.sale_id', 'sales.id')
            ->join('products', 'product_id', 'products.id')
            ->join('sale_documents', 'sale_documents.sale_id', 'sales.id')
            ->join('people', 'client_id', 'people.id')
            ->join('series', 'serie_id', 'series.id')
            ->join('users', 'sales.user_id', 'users.id')
            ->select(
                'sales.id',
                'products.description AS product_description',
                'products.interne',
                'series.description',
                'sale_documents.number',
                'sale_products.product',
                'sale_products.total AS product_total',
                'sales.total',
                'people.full_name',
                'sales.payments',
                'users.name AS user_name',
                DB::raw("(SELECT seller_name FROM petty_cashes WHERE petty_cashes.id=sales.petty_cash_id) AS seller_name")
            )
            ->where(function ($query) {
                if (!Auth::user()->hasRole('admin')) {
                    $query->where('sales.user_id', Auth::id());
                }
            })
            ->whereDate('sales.created_at', $date)
            ->where('sales.status', true)
            ->where('sales.local_id', Auth::user()->local_id)
            ->orderBy('sales.id')
            ->get();

        $products = SaleProduct::join('sales', 'sale_id', 'sales.id')
            ->join('products', 'product_id', 'products.id')
            ->select(
                'products.interne',
                'products.image',
                'products.description',
                'sale_products.product',
                'sale_products.price',
                'sale_products.discount',
                'sale_products.quantity',
                'sale_products.total'
            )
            ->whereDate('sales.created_at', $date)
            ->where(function ($query) {
                if (!Auth::user()->hasRole('admin')) {
                    $query->where('sales.user_id', Auth::id());
                }
            })
            ->where('sales.status', true)
            ->where('sales.local_id', Auth::user()->local_id)
            ->get();

        $status = false;
        //dd($products);
        if (count($sales) > 0) {
            $status = true;

            $file = public_path('ventas/') . 'ventas.pdf';

            $pdf = PDF::loadView('sales::sales.sale_day', [
                'header' => $header,
                'sales' => $sales,
                'payments' => $payments,
                'products' => $products
            ]);

            $pdf->setPaper('A4', 'portrait');
            $pdf->save($file);

            return response()->download($file, 'ventas_' . $date . '.pdf', [
                'Content-Type' => 'application/pdf',
            ]);
        } else {
            return response()->json([
                'status' => $status,
                'message' => 'No existen Datos'
            ]);
        }
    }
}
