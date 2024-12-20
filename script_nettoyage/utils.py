import pandas as pd


def enleve_espace(chaine: str) -> str:
    """
    Enlève les espaces au début et à la fin d'une chaîne.
    Si la chaîne est ou vide ou 'NR' on retourne None.

    Args:
        chaine (str): La chaîne à nettoyer

    Returns:
        str: La valeur nettoyée
    """
    chaine = str(chaine).strip() # Enlever les espaces début et fin
    if chaine.upper() in ['', 'NR', 'NAN']:
        return None
    return chaine


def excelToId(data: pd.DataFrame) -> pd.Series:
    """
    Retourne tous les identifiants après nettoyage.
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les identifiants
    """
    
    ids = data["Unnamed: 0"]
    tab = []
    for id in ids:
        try: # on essaye de passer id en int
            float_id = float(id)
            if float_id.is_integer():
                tab.append(int(float_id)) # on ajoute au tab le id
        except ValueError: # si pas possible, erreur
            tab.append(id) # on ajoute quand même l'id pour ne pas rater la ligne
    return pd.Series(tab)

def excelToTitre(data: pd.DataFrame) -> pd.Series:
    """
    Retourne les titres après nettoyage (strip, enlever les vides).
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les titres
    """
    titres = data["TITRE"]
    titres_clean = titres.apply(enleve_espace)
    titres_clean_title = []
    for titre in titres_clean:
        titres_clean_title.append(titre.title())
    return pd.Series(titres_clean_title)

def excelToRef(data: pd.DataFrame) -> pd.Series:
    """
    Retourne les références après nettoyage (strip, vérifier les vides).
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les références
    """
    refs = data["REFERENCES (éditeur/distributeur)"]
    refs_clean = refs.apply(enleve_espace)
    tab = []
    for ref in refs_clean:
        if ref == None:
            tab.append(None)
        elif "/" in ref:
            ref_split = ref.split("/")
            
    return pd.Series(refs_clean)

def excelToAuteur(data: pd.DataFrame) -> pd.Series:
    """
    Retourne les auteurs après nettoyage (strip, 'NR' devient None).
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les auteurs
    """
    auteurs = data["AUTEURS"]
    auteurs_clean = auteurs.apply(enleve_espace)
    return auteurs_clean

def excelToDateParutionDebut(data: pd.DataFrame) -> pd.Series:
    """
    Retourne les dates de début de parution après nettoyage (strip, vérifier les dates négatives).
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les dates de début de parution
    """
    dates_debut = data["DATE DE PARUTION DEBUT"].apply(enleve_espace)

    # Nettoyer les dates
    date_debut_clean = []
    for date in dates_debut:
        if date is None or (not(date.isdigit())) or (int(date) < 0):
            date_debut_clean.append(None)  # None si date vide ou négatif
        else:
            date_debut_clean.append(date)
    
    return pd.Series(date_debut_clean)

def excelToDateParutionFin(data: pd.DataFrame) -> pd.Series:
    """
    Retourne les dates de fin de parution après nettoyage (strip, vérifier les dates négatives).
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les dates de fin de parution
    """
    dates_fin = data["DATE DE PARUTION FIN"].apply(enleve_espace)
    
    # Nettoyer les dates
    date_debut_fin = []
    for date in dates_fin:
        date = enleve_espace(date)
        if date == '' or date is None or not date.isdigit() or int(date) < 0:
            date_debut_fin.append(None)  # None si date vide ou négatif
        else:
            date_debut_fin.append(date)
    
    return pd.Series(date_debut_fin)

def excelToInformation(data: pd.DataFrame) -> pd.Series:
    """
    Retourne toutes les informations.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'INFORMATION DATA'
    """
    info = data["INFORMATION DATE"].apply(enleve_espace)
    return info

def excelToVersion(data: pd.DataFrame) -> pd.Series:
    """
    Retourne les versions après nettoyage (strip, vider les vides).
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les versions
    """
    versions = data["VERSION"]
    
    # Nettoyer les versions
    versions_clean = versions.apply(enleve_espace)
    versions_clean_lower = []
    for version in versions_clean:
        if type(version) == str: # si la version est un str et pas un None
            versions_clean_lower.append(version.title()) # on met en mini sauf la prem. lettre
    return pd.Series(versions_clean_lower)


def excelToNbJoueurs(data: pd.DataFrame) -> pd.Series:
    """
    Nettoie et normalise les informations de la colonne 'NOMBRE DE JOUEURS'.
    
    Args:
        data (pd.DataFrame): DataFrame contenant les données du fichier excel.
    
    Returns:
        pd.Series: Série pandas nettoyée et normalisée contenant les informations sur le nombre de joueurs.
    """
    # dico qui représente les associations possibles
    equivalent = {
        "ou": "",
        "à": "-",
        "équipes": " en équipes ",
        "+": " ou plus ",
        "et": "",
        "joueurs": ""
    }

    nb_joueur = data["NOMBRE DE JOUEURS"]
    nb_joueur_clean = []

    for nb in nb_joueur:
        res = ""
        nb = str(enleve_espace(nb)) # on transforme toujours en string
        liste_nb = nb.split(" ") # pour séparer les élements de la chaine

        for char in liste_nb:
            if char.isdigit(): # si c'est un num on ajoute dans le resultat
                res += char
            elif char in equivalent: # si le char est dans le dico
                res += equivalent[char]
            else: # pour le reste on met None
                res = None
                break

        nb_joueur_clean.append(res if res is None else res.strip())

    return pd.Series(nb_joueur_clean)
    
        

def excelToAge(data: pd.DataFrame) -> pd.Series:
    """
    Retourne l'âge minimum après nettoyage des valeurs incohérentes.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données Excel

    Returns:
        pd.Series: Une série contenant les âges nettoyés
    """
    def clean_age(val):
        val = enleve_espace(val)
        chaine = ""
        if val != None: # => si la val est un str
            for char in val: # on parcourt la chaine qui représente l'âge
                if char.isdigit(): # si c'est un chiffre on ajoute à la chaine finale
                    chaine += char
                if char == " ": # si il y a un espace on retourne directement la chaine, ça permet d'avoir "l'âge minimum"
                    return chaine
        else:
            return None
        return chaine
    
    return data["AGE INDIQUE (cf colonne B)"].apply(clean_age)


def excelToMotsCles(data: pd.DataFrame) -> pd.Series:
    """
    Retourne les mots-clés après nettoyage (mettre en lowercase).
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les mots-clés
    """
    mots_cles = data["MOTS CLES"]
    
    mots_cles_clean = []
    
    for x in mots_cles:
        # Enlever les espaces et mettre en lower
        valeur_clean = enleve_espace(str(x))
        if valeur_clean == None:
            mots_cles_clean.append(None)
        else:
            mots_cles_clean.append(valeur_clean.title())

    return pd.Series(mots_cles_clean)
    
def excelToNumBoite(data: pd.DataFrame) -> pd.Series:
    """
    Retourne tout les numéros de boîte.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'N Boîte'
    """
    numsBoite = data["N Boîte"].apply(enleve_espace)
    numsBoite_clean = []
    for num in numsBoite:
        if num is None or not num.isdigit():
            numsBoite_clean.append(None)
        else:
            numsBoite_clean.append(num)
    return pd.Series(numsBoite_clean)

def excelToLocalisation(data: pd.DataFrame) -> pd.Series:
    """
    Retourne toutes les localisations au CNJ.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'LOCALISATION_CNJ'
    """
    localisations = data["LOCALISATION_CNJ"].apply(enleve_espace)
    localisations_lower = []

    for localisation in localisations:
        if localisation != None: # = si localisation == str
            localisations_lower.append(localisation.title()) # on le met en mini sauf prem. lettre
        else:
            localisations_lower.append(None)
    
    return pd.Series(localisations_lower)


def excelToMecanisme(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne tous les mécanismes après nettoyage des valeurs.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.DataFrame: un DataFrame contenant les trois colonnes de mécanisme nettoyées
    """
    # Trouver la position de la colonne "MECANISME (cf colonne A)"
    index_meca = data.columns.get_loc("MECANISME (cf colonne A)")
    
    # Sélectionner les 3 colonnes des mécanismes
    mecanismes = data.iloc[:, [index_meca, index_meca + 1, index_meca + 2]]
    
    # Appliquer le nettoyage sur chaque colonne
    for col in mecanismes.columns:
        mecanismes.loc[:, col] = mecanismes[col].apply(enleve_espace)
        for meca in mecanismes[col]:
            if meca != None:
                meca = meca.title()
    
    return mecanismes

def excelToCollectionOrigine(data: pd.DataFrame) -> pd.Series:
    """
    Retourne toutes les collections d'origine.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'Collecction d'origine (cf colonne C)'
    """
    collection_origine = data["Collection d'origine (cf colonne C)"].apply(enleve_espace)
    collection_origine_clean = []
    for collection in collection_origine:
        if collection is not None:
            collection_origine_clean.append(collection.title())
        else:
            collection_origine_clean.append(None)
    return pd.Series(collection_origine_clean)

def excelToEtat(data: pd.DataFrame) -> pd.Series:
    """
    Retourne tout les états.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'Etat'
    """
    etats = data["Etat"].apply(enleve_espace)
    etat_clean = []
    for etat in etats:
        if etat is not None:
            etat_clean.append(etat.title())
    return pd.Series(etat)

def excelToCodeBarre(data: pd.DataFrame) -> pd.Series:
    """
    Retourne tout les codes barres.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'Code barre'
    """
    codesBarres = data["Code barre"].apply(enleve_espace)
    codesBarres_clean = []
    for code in codesBarres:
        if code is None or not code.isdigit():
            codesBarres_clean.append(None)
        else:
            codesBarres_clean.append(code)
    return pd.Series(codesBarres_clean)

def excelGetLine(data: pd.DataFrame, indice: int) -> pd.Series:
    """
    Retourne une seule ligne du fichier.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
        indice (int): Indice de la ligne
        
    Returns:
        pd.Series: une série pandas qui contient toutes les valeurs de la ligne choisit
    """
    return data.iloc[indice]

def excelTrieParId(data):
    
    data["cleaned_id"] = data["id_jeu"]
    data_trie = data.sort_values(by="cleaned_id")
    data_trie = data_trie.drop(columns=["cleaned_id"])

    return data_trie