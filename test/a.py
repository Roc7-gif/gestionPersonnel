import requests

data = requests.post('http://127.0.0.1:8000/api/formations',json ={                        
            # 'demandeformation_id' : '14',
            # 'status' : 'validé',
  "intitule": "Formation en Développement Web",
  "nombre_participants": 25,
  "objectifs": "Apprendre les bases du développement web avec HTML, CSS et JavaScript.",
  "profils_beneficiaires": "Étudiants, jeunes diplômés",
  "debut": "2026-03-01",
  "fin": "2026-03-15",
  "type_formation": "presentiel",
  "img_path": "formations/dev_web.png",

},
headers={
'Accept': 'application/json',
'Content-Type': 'application/json', 
'Authorization': 'Bearer 1|BNZCu9kocRSWgSZuLKZTnpcfmMpkF0PLwctRomXDa1d1ebed'
} )

# 4|NPvq33SEQ6sTn2CQ16HftTTMePA5pa8iD9l7ayoM1e811daf 1|BNZCu9kocRSWgSZuLKZTnpcfmMpkF0PLwctRomXDa1d1ebed
print(data.json())
