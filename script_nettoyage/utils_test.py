from utils import *

"""
Fichier de test des fonctions dans utils.py
"""

# Création d'un DataFrame pour les tests


path = "inventaire_extrait.xlsx"

data = pd.read_excel(path)

# Test pour excelToId
#print("Test excelToId:" + "\n" + str(excelToId(data)))

# Test pour excelToTitre
#print("\nTest excelToTitre:" + "\n" + str(excelToTitre(data)))

# Test pour excelToRef
#print("\nTest excelToRef:" + "\n" + str(excelToRef(data)))

# Test pour excelToAuteur
#print("\nTest excelToAuteur:" + "\n" + str(excelToAuteur(data)))

# Test pour excelToDateParutionDebut
#print("\nTest excelToDateParutionDebut:" + "\n" + str(excelToDateParutionDebut(data)))

# Test pour excelToDateParutionFin
#print("\nTest excelToDateParutionFin:" + "\n" + str(excelToDateParutionFin(data)))

# Test pour excelToInformation
#print("\nTest excelToInformation:" + "\n" + str(excelToInformation(data)))

# Test pour excelToVersion
#print("\nTest excelToVersion:" + "\n" + str(excelToVersion(data)))

# Test pour excelToMotsCles
#print("\nTest excelToMotsCles:" + "\n" + str(excelToMotsCles(data)))

# Test pour excelToNbJoueurs
print("\nTest excelToNbJoueurs:" + "\n" + str(excelToNbJoueurs(data)))

# Test pour excelToAge
#print("\nTest excelToAge:" + "\n" + str(excelToAge(data)))

# Test pour excelToMotsCles
#print("\nTest excelToMotsCles:" + "\n" + str(excelToMotsCles(data)))

# Test pour excelToNumBoite
#print("\nTest excelToNumBoite:" + "\n" + str(excelToNumBoite(data)))

# Test pour excelToLocalisation
#print("\nTest excelToLocalisation:" + "\n" + str(excelToLocalisation(data)))

# Test pour excelToMecanisme
#print("\nTest excelToMecanisme:" + "\n" + str(excelToMecanisme(data)))