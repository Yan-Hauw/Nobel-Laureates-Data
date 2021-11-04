import json

# load data
data = json.load(open("/home/cs143/data/nobel-laureates.json", "r"))

laureate_fp = open('Laureates.del', 'w')


for l in data["laureates"]:

    id=l["id"]
    null=','+'\\N'

    gN = fN = gender = orgN = null

    if "givenName" in l.keys():
        gN=',"'+l["givenName"]["en"]+'"'

    if "familyName" in l.keys():
        fN=',"'+l["familyName"]["en"]+'"'

    if "gender" in l.keys():
        gender= ',"'+l["gender"]+'"'

    if "orgName" in l.keys():
        orgN=',"'+l["orgName"]["en"]+'"'

    laureate_fp.write(id+gN+fN+gender+orgN)
    laureate_fp.write('\n')

laureate_fp.close()



birth_fp = open('Birth.del', 'w')

for l in data["laureates"]:

    id=l["id"]
    null=','+'\\N'

    date = city = country = null

    if "birth" in l.keys():
        if "date" in l["birth"].keys():
            date = ',"'+l["birth"]["date"]+'"'
        if "city" in l["birth"].keys():
            city = ',"'+l["birth"]["city"]+'"'
        if "country" in l["birth"].keys():
            country = ',"'+l["birth"]["country"]+'"'


    birth_fp.write(id+date+city+country)
    birth_fp.write('\n')

birth_fp.close()





