import requests
data = requests.get('http://127.0.0.1:8000/api/my/formations',json =  {
                   
  # "intitule": "Maîtrise de Laravel 11 et des API REST",
  # "nombre_participants": 15,
  # "objectifs": "Apprendre à concevoir une base de données robuste, créer des contrôleurs API et sécuriser les routes avec Sanctum.",
  # "img_path": "uploads/formations/laravel-dev.jpg",
  # "is_interieur": True,
  # "justification_choix": "Demande croissante de l'équipe technique pour moderniser le backend de nos applications internes.",
  # "profils_beneficiaires": "Développeurs Junior et Middle",
  # "module_nom": "Développement Backend",
  # "duree": "5 jours (35 heures)",
  # "profil_formateur": "Expert Senior en Architecture Logicielle",
  # "type_formation": "presentiel",
  # "debut": "2026-03-15",
  # "observation": "Prévoir l'installation de Docker sur les postes des participants avant le début."

# 'demandeformation_id' : 10,
#                            'status' : 'en attente',

                        #  'name' :'roc',
                        #  'email' :'roc@gmail.com',
                        #  'password' :'zmzzmzzmcz',
                        #  'password_confirmation' :'zmzzmzzmcz',
                        #  'parent_id' :''
  # "intitule": "Formation Cool sur la Cybersécurité",
  # "nombre_participants": 12,
  # "objectifs": "Maîtriser les protocoles de sécurité réseau, apprendre à identifier les vulnérabilités et mettre en place un plan de réponse aux incidents.",
  # "is_interieur": True,
  # "justification_choix": "Nécessité de renforcer la sécurité interne suite à l'augmentation des tentatives de phishing constatées au dernier trimestre.",
  # "profils_beneficiaires": "Administrateurs réseaux, Développeurs Senior, Responsables SI",
  # "module_nom": "Sécurité des Systèmes d'Information (SSI)",
  # "duree": "5 jours (35 heures)",
  # "profil_formateur": "Expert certifié CISSP avec minimum 10 ans d'expérience",
  # "type_formation": "presentiel",
  # "observation": "Prévoir une salle avec accès internet haut débit et projecteur.",
  # "user_actuel_id": 1
} ,
headers={
    'Accept': 'application/json',
'Content-Type': 'application/json', 
'Authorization': f'Bearer 2|IwGTh4rDQRpvJDCzmHAVgjQg7Qace1rF9xyZ4QOpaa82bb12'
} )

print(data.json())