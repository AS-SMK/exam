<?php

namespace App\Notifications;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    public $commande;

    /**
     * Create a new notification instance.
     */
    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail']; // on envoie uniquement par email
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle commande reçue')
            ->greeting('Bonjour Gestionnaire,')
            ->line("Une nouvelle commande (#{$this->commande->id}) a été passée.")
            ->line("Client : {$this->commande->user->name}")
            ->line("Total : " . number_format($this->commande->total, 2, ',', ' ') . " €")
            ->action('Voir la commande', url('/showCommande/' . $this->commande->id))
            ->line('Merci d’utiliser ipp BURGER.');
    }
}
