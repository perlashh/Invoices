<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\invoices;
use Illuminate\Support\Facades\Auth;

class add_invoice_new extends Notification
{
    use Queueable;
    private $invoice;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(invoices $invoice)
    {
        //
        $this->invoice=$invoice;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }


    public function toDatabase($notifiable)
    {
        return [
          // 'data' => $this->details['body']
          'id'=>$this->invoice->id,
          'title'=>'تم اضافة الفاتورة بواسطة:',
          'user'=>Auth::user()->name,
        ];
    }
}
