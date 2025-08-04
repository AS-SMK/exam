<?php


namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Burger;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommandeConfirmee;

use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commandes = Commande::paginate(5);
        $burgers = Burger::Paginate(5);

        return view('commande.commande', compact('commandes', 'burgers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    // Création de la commande vide
    $commande = new Commande();
    $commande->user_id = auth()->id();
    $commande->statut = 'en_attente';
    $commande->total = 0;
    $commande->save();

    // Ajouter les burgers à la commande et calculer le total
    foreach ($request->input('burgers') as $burgerId) {
        $burger = Burger::findOrFail($burgerId);
        $commande->burgers()->attach($burgerId, ['quantite' => 1]); // ou récupère la vraie quantité
        $commande->total += $burger->prix;
    }

    // Mettre à jour le total
    $commande->save();

    // 1️⃣ Email au client
    Mail::to($commande->user->email)->send(new CommandeConfirmee($commande));

    // 2️⃣ Email au(x) gestionnaire(s)
    $gestionnaires = \App\Models\User::where('role', 'gestionnaire')->get();
    foreach ($gestionnaires as $gestionnaire) {
        $gestionnaire->notify(new NewOrderNotification($commande));
    }

    return redirect()->route('commande')->with('success', 'Commande créée, email client et notification gestionnaire envoyés.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $commande = Commande::findOrFail($id);
        return view('commande.showCommande', compact('commande'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $commande = Commande::findOrFail($id);
        $commande->statut = $request->statut;

        if ($request->statut == 'payee') {
            $commande->date_commande = now();
            $commande->total = $request->montant_paye;
        }

        // if ($request->statut == 'prete') {
        //     $commande->user->notify(new FacturePDFNotification($commande));
        // }


        $commande->save();
        return redirect()->route('showCommande', $commande->id)->with('success', 'Statut de la commande mis à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $commande = \App\Models\Commande::find($id);
        $commande->delete();

        return redirect('commande')->with("messageDelete", "Commande annulé avec succes");
    }
}
