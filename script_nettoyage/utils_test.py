from utils import *

"""
Fichier de test des fonctions dans utils.py
"""

# Création d'un DataFrame pour les tests


path = "./data/inventaire_perso.xlsx"

data = pd.read_excel(path)

# Test pour excelToId
print("Testing excelToId:" + "\n" + str(excelToId(data)))

# Test pour excelToTitre
print("\nTesting excelToTitre:" + "\n" + str(excelToTitre(data)))

# Test pour excelToRef
print("\nTesting excelToRef:" + "\n" + str(excelToRef(data)))

# Test pour excelToAuteur
print("\nTesting excelToAuteur:" + "\n" + str(excelToAuteur(data)))

# Test pour excelToDateParutionDebut
print("\nTesting excelToDateParutionDebut:" + "\n" + str(excelToDateParutionDebut(data)))

# Test pour excelToDateParutionFin
print("\nTesting excelToDateParutionFin:" + "\n" + str(excelToDateParutionFin(data)))

# Test pour excelToVersion
print("\nTesting excelToVersion:" + "\n" + str(excelToVersion(data)))

# Test pour excelToMotsCles
print("\nTesting excelToMotsCles:" + "\n" + str(excelToMotsCles(data)))

# Test pour excelToMecanisme
print("\nTesting excelToMecanisme:" + "\n" + str(excelToMecanisme(data)))
