# SAE3.01: Développement d'une application<sub>2024-2025</sub>

## Script de nettoyage
Ce répertoire contient les scripts permettant de nettoyer le fichier Excel.

## Fonctionnement

###  `utils.py`
Le fichier `utils.py` contient des fonctions utilitaires pour extraire des colonnes spécifiques du fichier Excel et les nettoyer.

### `utils_test.py`
Le fichier `utils_test.py` s'occupe de tester les fonctions de `utils.py` (pas toutes).

### `nettoyage.py`
Le fichier `nettoyage.py` contient les fonctions qui permetteront de nettoyer le fichier Excel. 
Il y a plusieurs étapes pour ce nettoyage :
1. **Suppression des doublons** : Les doublons sont supprimés pour garantir que chaque ligne du fichier soit unique.
2. **Gestion des valeurs manquantes** : Les valeurs manquantes dans les colonnes de texte sont remplacées par `None`.
3. **Enlèvement des espaces inutiles** : Les espaces avant et après les chaînes de texte sont supprimés pour éviter les erreurs liées aux valeurs de texte mal formatées.
4. **CONTINUER A RAJOUTER**

## Equipe du projet
Ce projet est réalisé par l'équipe suivante : 
- **[Mehdi ARRAB](https://github.com/jadoothepooh/)**
- **[Lasry BESKIWIN](https://github.com/Lasryy)**
- **[Rania Bousfiha](https://github.com/rania212)**
- **[Safiya NGUYEN](https://github.com/safiya-ng)**
- **[Ahash PARTHIPAN](https://github.com/AhashPARTHIPAN)**
- **[Jules RICHARDOT](https://github.com/JulesRichardot)**
