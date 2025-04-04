<?php

namespace Modules\CRM\Http\Controllers;

use App\Models\Person;
use App\Http\Controllers\Controller;
use App\Models\Parameter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Modules\CRM\Entities\CrmConversation;
use Modules\CRM\Entities\CrmMessage;
use Modules\CRM\Entities\CrmParticipant;

class CrmChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $P000015;

    public function __construct()
    {
        $this->P000015 = Parameter::where('parameter_code', 'P000015')->value('value_default');
    }

    public function index(Request $request)
    {
        return Inertia::render('CRM::Chat/Dashboard', [
            'P000015' => $this->P000015
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getContacts()
    {
        $persomId = Auth::user()->person_id;
        $persons = Person::join('users', 'people.id', 'users.person_id')
            ->select('people.*')
            ->where('people.id', '<>', $persomId)
            ->latest();


        if (request()->has('search')) {
            $persons->where('people.full_name', 'like', '%' . request()->input('search') . '%');
        }

        $persons = $persons->paginate(5);

        // Modificar cada registro antes de devolverlo
        $formattedPersons = $persons->getCollection()->map(function ($person) use ($persomId) {
            // // Formatear las fechas
            // $person->created_at_formatted = $person->created_at->format('Y-m-d H:i:s');
            // $person->updated_at_formatted = $person->updated_at->format('Y-m-d H:i:s');

            // Agregar el campo estado basado en alguna condición
            $conversationId = CrmParticipant::whereIn('person_id', [$persomId, $person->id])
                ->groupBy('conversation_id')
                ->having(DB::raw('COUNT(DISTINCT user_id)'), '>=', 2)
                ->value('conversation_id');

            $message_active = false;
            $message_last = CrmMessage::where('conversation_id', $conversationId)
                ->orderByDesc('id')
                ->first();

            $preview = '';
            if ($message_last) {
                $who = $message_last->person_id == $persomId ? 'Tu: ' : '';

                if ($message_last->type == 'text') {
                    $preview = ($who . $message_last->content);
                } else if ($message_last->type == 'audio') {
                    $preview = ($who . 'audio');
                } else if ($message_last->type == 'link') {
                    $preview = ($who . 'enlace');
                } else {
                    $preview = ($who . 'archivo');
                }
                $see = CrmConversation::where('id', $conversationId)->value('new_message');
                $message_active = $message_last->person_id != $persomId ? $see : false;
            }

            $person->conversationId = $conversationId;
            $person->newMessage = $message_active ?? false;
            $person->userId = $person->id;
            $person->time = $message_last ? timeElapsed($message_last->created_at) : null;
            $person->preview = $message_last ? $preview : null;
            $person->messages = [];
            $person->active = true;
            $person->new_order = $message_last ? $message_last->created_at : null;
            return $person;
        });

        // Ordenar por el campo new_order
        $formattedPersons = $formattedPersons->sortByDesc('new_order')->values();

        // Reemplazar la colección de personas en la paginación con la colección formateada
        $persons->setCollection($formattedPersons);
        return response()->json($persons);
    }
}
