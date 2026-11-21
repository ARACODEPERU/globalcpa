<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Examen - <?php echo e($student->person->full_name); ?></title>
    <style>
        @page {
            margin: 15mm;
            size: A4 portrait;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
            position: relative;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 10px;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            opacity: 0.05;
            z-index: -1;
            pointer-events: none;
        }

        .watermark img {
            width: 400px;
            height: auto;
        }

        .header {
            display: table;
            width: 100%;
            padding-bottom: 10px;
            border-bottom: 2px solid #2563eb;
            margin-bottom: 15px;
        }

        .header-logo {
            display: table-cell;
            width: 120px;
            vertical-align: middle;
        }

        .header-logo img {
            width: 100px;
            height: auto;
        }

        .header-title {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .header-title h1 {
            font-size: 18px;
            color: #1e40af;
            margin-bottom: 3px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-title h2 {
            font-size: 13px;
            color: #64748b;
            font-weight: normal;
        }

        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }

        .info-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .info-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .info-box-label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .info-box-value {
            font-size: 12px;
            color: #1e293b;
            font-weight: bold;
        }

        .result-box {
            display: table;
            width: 100%;
            background: #f0fdf4;
            border: 2px solid #22c55e;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
        }

        .result-box.reprobado {
            background: #fef2f2;
            border-color: #ef4444;
        }

        .result-box.revision {
            background: #fffbeb;
            border-color: #f59e0b;
        }

        .result-status {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .result-status.aprobado {
            color: #16a34a;
        }

        .result-status.reprobado {
            color: #dc2626;
        }

        .result-status.revision {
            color: #d97706;
        }

        .result-note {
            font-size: 28px;
            font-weight: bold;
            color: #1e293b;
        }

        .result-note span {
            font-size: 14px;
            color: #64748b;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #1e40af;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 0;
            border-bottom: 1px solid #dbeafe;
            margin-bottom: 10px;
        }

        .question-item {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            page-break-inside: avoid;
        }

        .question-header {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .question-number {
            display: table-cell;
            width: 25px;
            vertical-align: top;
        }

        .question-number span {
            font-size: 12px;
            font-weight: bold;
            color: #1e293b;
        }

        .question-content {
            display: table-cell;
            vertical-align: top;
        }

        .question-type {
            display: inline-block;
            font-size: 8px;
            padding: 2px 6px;
            border-radius: 3px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .type-alternativas {
            background: #dcfce7;
            color: #166534;
        }

        .type-varias {
            background: #e0e7ff;
            color: #3730a3;
        }

        .type-escribir {
            background: #fef3c7;
            color: #92400e;
        }

        .type-archivo {
            background: #fce7f3;
            color: #9d174d;
        }

        .question-text {
            font-size: 11px;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .question-points {
            font-size: 9px;
            color: #64748b;
        }

        .answer-section {
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px dashed #e2e8f0;
        }

        .answer-label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .answer-text {
            font-size: 11px;
            color: #1e293b;
            padding: 5px 8px;
            background: #f1f5f9;
            border-radius: 3px;
        }

        .answer-correct {
            background: #dcfce7;
            border: 1px solid #86efac;
        }

        .answer-incorrect {
            background: #fee2e2;
            border: 1px solid #fca5a5;
        }

        .answer-pending {
            background: #fef3c7;
            border: 1px solid #fcd34d;
        }

        .correct-answer {
            margin-top: 5px;
            padding: 5px 8px;
            background: #ecfdf5;
            border: 1px solid #6ee7b7;
            border-radius: 3px;
            font-size: 10px;
            color: #047857;
        }

        .score-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }

        .score-full {
            background: #dcfce7;
            color: #166534;
        }

        .score-partial {
            background: #fef3c7;
            color: #92400e;
        }

        .score-zero {
            background: #fee2e2;
            color: #991b1b;
        }

        .score-pending {
            background: #e0e7ff;
            color: #3730a3;
        }

        .summary-section {
            margin-top: 20px;
            padding: 15px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .summary-row {
            display: table;
            width: 100%;
            padding: 5px 0;
        }

        .summary-label {
            display: table-cell;
            width: 60%;
            color: #64748b;
        }

        .summary-value {
            display: table-cell;
            width: 40%;
            text-align: right;
            font-weight: bold;
            color: #1e293b;
        }

        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
        }

        .footer p {
            font-size: 9px;
            color: #94a3b8;
        }

        .icon-correct {
            color: #22c55e;
        }

        .icon-incorrect {
            color: #ef4444;
        }

        .icon-pending {
            color: #f59e0b;
        }

        table.answers-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        table.answers-table td {
            padding: 5px;
            border: 1px solid #e2e8f0;
            font-size: 10px;
        }

        table.answers-table th {
            padding: 5px;
            border: 1px solid #e2e8f0;
            background: #f1f5f9;
            font-size: 9px;
            text-transform: uppercase;
            color: #64748b;
        }
    </style>
</head>

<body style="padding-left: 20px; padding-right: 20px; padding-top:10px">
    <?php if($watermark): ?>
    <div class="watermark">
        <img src="<?php echo e($watermark); ?>" alt="Marca de agua">
    </div>
    <?php endif; ?>

    <!-- Header -->
    <div class="header">
        <div class="header-logo">
            <?php if(file_exists($logo)): ?>
            <img src="<?php echo e($logo); ?>" alt="Logo">
            <?php endif; ?>
        </div>
        <div class="header-title">
            <h1>Resultado de Examen</h1>
            <h2><?php echo e($exam->course->description ?? 'Curso'); ?></h2>
        </div>
    </div>

    <!-- Información del Estudiante -->
    <div class="info-grid">
        <div class="info-col" style="padding-right: 10px;">
            <div class="info-box">
                <div class="info-box-label">Estudiante</div>
                <div class="info-box-value"><?php echo e($student->person->full_name ?? 'N/A'); ?></div>
            </div>
            <div class="info-box">
                <div class="info-box-label">Módulo</div>
                <div class="info-box-value"><?php echo e($exam->module->description ?? 'N/A'); ?></div>
            </div>
        </div>
        <div class="info-col" style="padding-left: 10px;">
            <div class="info-box">
                <div class="info-box-label">Fecha de Inicio</div>
                <div class="info-box-value"><?php echo e($examStudent->date_start ?? 'N/A'); ?></div>
            </div>
            <div class="info-box">
                <div class="info-box-label">Tiempo Utilizado</div>
                <div class="info-box-value">
                    <?php
                    $seconds = $examStudent->time_spent_seconds ?? 0;
                    $minutes = floor($seconds / 60);
                    $secs = $seconds % 60;
                    ?>
                    <?php echo e($minutes); ?> min <?php echo e($secs); ?> seg
                </div>
            </div>
        </div>
    </div>

    <!-- Resultado -->
    <?php
    $statusClass = '';
    $statusText = '';
    $isApproved = $examStudent->punctuation >= 11;

    if($examStudent->status === 'revision_pendiente') {
        $statusClass = 'revision';
        $statusText = 'En Revisión';
    } elseif($isApproved) {
        $statusClass = '';
        $statusText = 'Aprobado';
    } else {
        $statusClass = 'reprobado';
        $statusText = 'Desaprobado';
    }
    ?>

    <div class="result-box <?php echo e($statusClass); ?>">
        <div class="result-status <?php echo e($statusClass); ?>">
            <?php if($examStudent->status === 'revision_pendiente'): ?>
                Revision Pendiente
            <?php elseif($isApproved): ?>
                Aprobado
            <?php else: ?>
                Desaprobado
            <?php endif; ?>
        </div>
        <div class="result-note">
            <?php echo e($examStudent->punctuation ?? 0); ?> <span>/ <?php echo e($exam->questions->sum('score') ?? 0); ?></span>
        </div>
    </div>

    <!-- Preguntas -->
    <div class="section-title">Detalle de Preguntas</div>

    <?php
    $questionNumber = 0;
    ?>

    <?php $__currentLoopData = $exam->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $questionNumber++;
        $studentAnswer = $answersMap[$question->id] ?? null;
        $typeClass = '';
        $typeText = $question->type_answers;

        switch($question->type_answers) {
            case 'Alternativas':
                $typeClass = 'type-alternativas';
                break;
            case 'Varias respuestas':
                $typeClass = 'type-varias';
                break;
            case 'Escribir':
                $typeClass = 'type-escribir';
                break;
            case 'Subir Archivo':
                $typeClass = 'type-archivo';
                break;
        }
        ?>

        <div class="question-item">
            <div class="question-header">
                <div class="question-number">
                    <span><?php echo e($questionNumber); ?>.</span>
                </div>
                <div class="question-content">
                    <span class="question-type <?php echo e($typeClass); ?>"><?php echo e($typeText); ?></span>
                    <div class="question-text"><?php echo e($question->description); ?></div>
                    <div class="question-points">Puntuación: <?php echo e($question->score); ?> puntos</div>
                </div>
            </div>

            <div class="answer-section">
                <?php if($studentAnswer): ?>
                    <!-- Respuesta del estudiante -->
                    <?php if($question->type_answers === 'Alternativas'): ?>
                        <?php
                        $selectedAnswer = $studentAnswer['answers'] ?? null;
                        $answerObj = $question->answers->where('id', $selectedAnswer)->first();
                        $isCorrect = $answerObj && $answerObj->correct;
                        ?>
                        <?php if($showCorrectAnswers && $isApproved): ?>
                        <div class="answer-label">Tu respuesta:</div>
                            <div class="answer-text <?php echo e($isCorrect ? 'answer-correct' : 'answer-incorrect'); ?>">
                                <?php if($answerObj): ?>
                                    <?php echo e($answerObj->description); ?>

                                    <?php if($isCorrect): ?>
                                        <span class="icon-correct"> [Correcta]</span>
                                    <?php else: ?>
                                        <span class="icon-incorrect"> [Incorrecta]</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    Sin respuesta
                                <?php endif; ?>
                            </div>


                            <?php
                            $correctAnswer = $question->answers->where('correct', 1)->first();
                            ?>
                            <?php if($correctAnswer): ?>
                                <div class="correct-answer">
                                    Respuesta correcta: <?php echo e($correctAnswer->description); ?>

                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                    <?php elseif($question->type_answers === 'Varias respuestas'): ?>
                        <?php
                        $selectedIds = $studentAnswer['answers'] ?? [];
                        if(!is_array($selectedIds)) $selectedIds = [$selectedIds];
                        ?>
                        <?php if($showCorrectAnswers): ?>
                            <div class="answer-label">Tu respuesta:</div>
                            <div class="answer-text <?php echo e($studentAnswer['punctuation'] > 0 ? 'answer-correct' : 'answer-incorrect'); ?>">
                                <?php $__currentLoopData = $selectedIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $ans = $question->answers->where('id', $selId)->first();
                                    ?>
                                    <?php if($ans): ?>
                                        - <?php echo e($ans->description); ?>

                                        <?php if($ans->correct): ?>
                                            <span class="icon-correct">[Correcta]</span>
                                        <?php else: ?>
                                            <span class="icon-incorrect">[Incorrecta]</span>
                                        <?php endif; ?><br>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>


                            <?php
                            $correctAnswers = $question->answers->where('correct', 1);
                            ?>
                            <?php if($correctAnswers->count() > 0): ?>
                                <div class="correct-answer">
                                    Respuestas correctas:<br>
                                    <?php $__currentLoopData = $correctAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ca): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        - <?php echo e($ca->description); ?><br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                    <?php elseif($question->type_answers === 'Escribir'): ?>
                        <div class="answer-label">Tu respuesta:</div>
                        <div class="answer-text answer-pending">
                            <?php echo e($studentAnswer['answers'] ?? 'Sin respuesta'); ?>

                            <span class="icon-pending"> [Pendiente de revisión]</span>
                        </div>

                    <?php elseif($question->type_answers === 'Subir Archivo'): ?>
                        <div class="answer-label">Tu respuesta:</div>
                        <div class="answer-text answer-pending">
                            <?php if(isset($studentAnswer['answers']) && $studentAnswer['answers']): ?>
                                Archivo adjunto: <?php echo e($studentAnswer['answers']); ?>

                            <?php else: ?>
                                Sin archivo adjunto
                            <?php endif; ?>
                            <span class="icon-pending"> [Pendiente de revisión]</span>
                        </div>
                    <?php endif; ?>

                    <!-- Puntuación obtenida -->
                    <div style="margin-top: 5px;">
                        <?php
                        $scoreClass = '';
                        $scoreText = $studentAnswer['punctuation'] ?? 0;

                        if($question->type_answers === 'Escribir' || $question->type_answers === 'Subir Archivo') {
                            $scoreClass = 'score-pending';
                            $scoreText = 'Pendiente';
                        } elseif($scoreText >= $question->score) {
                            $scoreClass = 'score-full';
                        } elseif($scoreText > 0) {
                            $scoreClass = 'score-partial';
                        } else {
                            $scoreClass = 'score-zero';
                        }
                        ?>
                        <span class="score-badge <?php echo e($scoreClass); ?>">
                            Puntuación: <?php echo e($scoreText); ?>/<?php echo e($question->score); ?>

                        </span>
                    </div>

                <?php else: ?>
                    <div class="answer-text" style="background: #f1f5f9; color: #94a3b8;">
                        Sin responder
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- Resumen -->
    <div class="summary-section">
        <div class="section-title" style="margin-bottom: 10px;">Resumen</div>

        <?php
        $totalQuestions = $exam->questions->count();
        $answeredQuestions = count($details);
        $correctAnswers = collect($details)->where('punctuation', '>', 0)->count();
        $totalScore = collect($details)->sum('punctuation');
        ?>

        <div class="summary-row">
            <div class="summary-label">Total de preguntas:</div>
            <div class="summary-value"><?php echo e($totalQuestions); ?></div>
        </div>
        <div class="summary-row">
            <div class="summary-label">Preguntas respondidas:</div>
            <div class="summary-value"><?php echo e($answeredQuestions); ?></div>
        </div>
        <div class="summary-row">
            <div class="summary-label">Respuestas correctas:</div>
            <div class="summary-value"><?php echo e($correctAnswers); ?></div>
        </div>
        <div class="summary-row" style="border-top: 1px solid #e2e8f0; padding-top: 10px; margin-top: 5px;">
            <div class="summary-label" style="font-weight: bold;">NOTA FINAL:</div>
            <div class="summary-value" style="font-size: 16px; color: <?php echo e($isApproved ? '#16a34a' : '#dc2626'); ?>;">
                <?php echo e($examStudent->punctuation ?? 0); ?> / <?php echo e($exam->questions->sum('score') ?? 0); ?>

            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Documento generado el <?php echo e($generatedAt); ?></p>
        <p><?php echo e($company->business_name ?? $company->name ?? ''); ?></p>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\globalcpa\Modules\Academic\Resources\views\exams\student_exam_pdf.blade.php ENDPATH**/ ?>