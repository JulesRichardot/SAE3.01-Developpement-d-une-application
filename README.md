
# SAE3.01: Développement d'une application

## Contexte
L'Université Sorbonne Paris Nord possède une collection exceptionnelle de plus de 17 000 jeux de société, certains datant du XIXe siècle. Ce projet vise à concevoir une application web accompagnée de scripts pour gérer, organiser, et valoriser cette collection.

## Fonctionnalités principales
- **Nettoyage des données** : Correction des incohérences dans les fichiers Excel.
- **Base de données relationnelle** : Organisation structurée des informations.
- **Interface web** : Recherche avancée, gestion des prêts, et gestion de l'inventaire.
- **Scripts Python** : Manipulation automatisée des données.

## Structure du projet
```plaintext
SAE3.01-main/
├── app/              # Site web principal (MVC)
├── sql/              # Scripts SQL pour la base de données
├── scripts/          # Scripts Python et fichiers de données
├── archive/          # Prototype initial en HTML
├── README.md         # Documentation principale
```

## Installation
### Prérequis
- **Python 3.x** et `pip`
- Serveur web compatible PHP (comme XAMPP ou WAMP)
- MySQL pour la base de données

### Étapes
1. Installez les dépendances Python nécessaires :
   ```bash
   pip install pandas
   ```
2. Configurez la base de données avec les scripts SQL dans `sql/`.
3. Lancez le serveur web pour accéder à `app/index.php`.

## Équipe du projet
- **[Mehdi ARRAB](https://github.com/jadoothepooh/)**
- **[Lasry BESKIWIN](https://github.com/Lasryy)**
- **[Rania Bousfiha](https://github.com/rania212)**
- **[Safiya NGUYEN](https://github.com/safiya-ng)**
- **[Ahash PARTHIPAN](https://github.com/AhashPARTHIPAN)**
- **[Jules RICHARDOT](https://github.com/JulesRichardot)**

## Technologies utilisées
- **Langages** : Python, PHP, SQL
- **Base de données** : MySQL
- **Frontend** : HTML, CSS, JS
