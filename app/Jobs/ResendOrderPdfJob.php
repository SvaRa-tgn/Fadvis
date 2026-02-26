<?php

namespace App\Jobs;

use App\DTO\Job\ResentOrderPdfJobDTO;
use App\Mail\ResendOrderMail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ResendOrderPdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Order $order;
    protected string $email;
    protected string $pdfContent;

    public function __construct(ResentOrderPdfJobDTO $dto)
    {
        $this->order = $dto->order;
        $this->email = $dto->email;
        $this->pdfContent = $dto->pdfContent;
    }

    /** @return void */
    public function handle(): void
    {
        Mail::to($this->email)->send(
            new ResendOrderMail($this->order, $this->pdfContent)
        );
    }
}
