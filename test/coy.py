import requests

data = requests.post('http://127.0.0.1:8000/api/login',json =  {
                         'name' :'rc',
                         'email' :'rc@gmail.com',
                         'password' :'zmzzmzzmcz',
                         'password_confirmation' :'zmzzmzzmcz',
                         'parent_id' :1,
},
headers={
'Accept': 'application/json',
'Content-Type': 'application/json', 
'Authorization': 'Bearer 2|IwGTh4rDQRpvJDCzmHAVgjQg7Qace1rF9xyZ4QOpaa82bb12'
} )

# 2|b87CdbQljFhzaIH1BXt4WvU709M3yBikEcAv5HOa067cbb24
print(data.json())
