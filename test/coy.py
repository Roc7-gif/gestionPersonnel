import requests
data = requests.get('http://127.0.0.1:8000/api/demande_formations/',json = {
  "intitule": "Formation Cool sur la Cybersécurité",
  "nombre_participants": 12,
  "objectifs": "Maîtriser les protocoles de sécurité réseau, apprendre à identifier les vulnérabilités et mettre en place un plan de réponse aux incidents.",
  "is_interieur": True,
  "justification_choix": "Nécessité de renforcer la sécurité interne suite à l'augmentation des tentatives de phishing constatées au dernier trimestre.",
  "profils_beneficiaires": "Administrateurs réseaux, Développeurs Senior, Responsables SI",
  "module_nom": "Sécurité des Systèmes d'Information (SSI)",
  "duree": "5 jours (35 heures)",
  "profil_formateur": "Expert certifié CISSP avec minimum 10 ans d'expérience",
  "type_formation": "presentiel",
  "observation": "Prévoir une salle avec accès internet haut débit et projecteur.",
  "user_create_id": 1,
  "user_actuel_id": 1
} ,
headers={
    'Accept': 'application/json',
'Content-Type': 'application/json', 
'Authorization': f'Bearer 4|j1aLMcPCcozEZEA2a3gFciSCo2HrMj3m1uD5jU94d1978223'
} )

print(data.text)