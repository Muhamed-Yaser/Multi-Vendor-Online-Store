<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $addr = $this->order->billingAddress;
        return (new MailMessage)
            ->from('online-store@gmail.com', 'Online Store!') //if from doesnot exist , it will take the value from .env file
            ->greeting("Hello {$notifiable->name} !")
            ->subject("This order created by{$addr->name} who is in the country {$addr->courntry_name}")
            ->line("The order number is {$this->order->number}.")
            ->action('View Order', url('/home'))
            ->line('Thank you for using our Online Store!');
        // ->view('front.notifi'); if i have a view template to show notifi in it
    }

    public function toDatabase(object $notifiable)
    {
        $addr = $this->order->billingAddress;
        return  [
            'icon' => 'fas fa-envelope mr-2',
            'body' => "The order number is {$this->order->number} created by {$addr->name}.",
            'url' =>  url('/home'),
            'line' => 'Thank you for using our Online Store!',
            'oreder_id' => "order number {$this->order->id}"
        ];
    }

    public function toBroadcast(object $notifiable)
    {
        $addr = $this->order->billingAddress;
        return new BroadcastMessage ([
            'icon' => 'fas fa-envelope mr-2',
            'body' => "The order number is {$this->order->number} created by {$addr->name}.",
            'url' =>  url('/home'),
            'line' => 'Thank you for using our Online Store!',
            'oreder_id' => "order number {$this->order->id}"
        ]) ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
