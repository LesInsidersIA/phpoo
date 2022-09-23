<?php 

// class A {}
// class A {}

// function a(){}
// function a(){}
// Impossibilité de créer deux classes ou deux fonctions du même nom dans l'espace global

// Le fait de créer des namespace fait sauter cette limitation en considérant nos éléments/classes faisant parti comme de "dossier" différents

namespace Commerce1;
// echo __NAMESPACE__;
    class Commande 
    {
        public $nbCommande = 3;
    }

namespace Commerce2;
// echo __NAMESPACE__;
    class Produit 
    {
        public $nbProduit = 22;
    }

namespace Commerce3;
// echo __NAMESPACE__;
    class Panier 
    {
        public $nbProduitPanier = 2;
    }

    class Produit 
    {
        public $nbProduit = 12;
    }

