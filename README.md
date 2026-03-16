# ELECVOLTAIQUE

Site WordPress pour **ELECVOLTAIQUE** — votre expert en électricité, sécurité, énergie solaire et réseaux informatiques.

## Services couverts

- ⚡ Électricité (installation, mise aux normes, dépannage)
- 📷 Pose de caméras (vidéosurveillance IP/analogique)
- 🚨 Pose d'alarmes (intrusion, incendie, télésurveillance)
- ☀️ Pose de panneaux solaires (photovoltaïque, autoconsommation)
- 📡 Pose de liaisons point à point (radio, Wi-Fi bridge)
- 🔌 Courant fort et faible (distribution, câblage voix/data)
- 🗄️ Équipement des baies de brassage (patch panels, fibre optique)
- 🌐 Réseaux informatiques (LAN/WAN, Wi-Fi entreprise, VPN)

## Structure du thème

```
wp-content/themes/elecvoltaique/
├── style.css          # Feuille de style principale + métadonnées du thème
├── functions.php      # Configuration du thème, enregistrement des assets, handler AJAX
├── header.php         # En-tête (logo, navigation responsive)
├── footer.php         # Pied de page (liens, copyright)
├── index.php          # Page d'accueil (héro, services, pourquoi nous, contact)
├── page.php           # Gabarit de page générique
└── assets/
    └── js/
        └── main.js    # Navigation mobile, défilement doux, formulaire AJAX
```

## Installation

1. Déployer WordPress (≥ 6.0) sur votre hébergeur.
2. Copier le dossier `wp-content/themes/elecvoltaique/` dans le répertoire `wp-content/themes/` de votre installation WordPress.
3. Activer le thème depuis **Apparence › Thèmes** dans l'administration WordPress.
4. Assigner un menu à l'emplacement **Menu principal** depuis **Apparence › Menus**.
5. Personnaliser les coordonnées (téléphone, e-mail) directement dans `index.php`.

## Prérequis

- PHP ≥ 8.0
- WordPress ≥ 6.0
- Serveur web Apache ou Nginx
