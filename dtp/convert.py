import json

# load data
data = json.load(open("/home/cs143/data/nobel-laureates.json", "r"))

laureate_fp = open("Laureates.del", "w")


for l in data["laureates"]:

    id = l["id"]
    null = "," + "\\N"

    gN = fN = gender = orgN = null

    if "givenName" in l.keys():
        gN = ',"' + l["givenName"]["en"] + '"'

    if "familyName" in l.keys():
        fN = ',"' + l["familyName"]["en"] + '"'

    if "gender" in l.keys():
        gender = ',"' + l["gender"] + '"'

    if "orgName" in l.keys():
        orgN = ',"' + l["orgName"]["en"] + '"'

    laureate_fp.write(id + gN + fN + gender + orgN)
    laureate_fp.write("\n")

laureate_fp.close()


birth_fp = open("Birth.del", "w")

for l in data["laureates"]:

    id = l["id"]
    null = "," + "\\N"

    date = city = country = null

    if "birth" in l.keys():
        if "date" in l["birth"].keys():
            date = ',"' + l["birth"]["date"] + '"'
        if "place" in l["birth"].keys():
            if "city" in l["birth"]["place"].keys():
                city = ',"' + l["birth"]["place"]["city"]["en"] + '"'
            if "country" in l["birth"]["place"].keys():
                country = ',"' + l["birth"]["place"]["country"]["en"] + '"'

    birth_fp.write(id + date + city + country)
    birth_fp.write("\n")

birth_fp.close()


founded_fp = open("Founded.del", "w")

for l in data["laureates"]:

    id = l["id"]
    null = "," + "\\N"

    date = city = country = null

    if "founded" in l.keys():
        if "date" in l["founded"].keys():
            date = ',"' + l["founded"]["date"] + '"'
        if "place" in l["founded"].keys():
            if "city" in l["founded"]["place"].keys():
                city = ',"' + l["founded"]["place"]["city"]["en"] + '"'
            if "country" in l["founded"]["place"].keys():
                country = ',"' + l["founded"]["place"]["country"]["en"] + '"'

    founded_fp.write(id + date + city + country)
    founded_fp.write("\n")

founded_fp.close()


nobelprizes_fp = open("NobelPrizes.del", "w")
affiliations_fp = open("Affiliations.del", "w")

for l in data["laureates"]:

    id = l["id"]
    null = "," + "\\N"

    awardYear = category = sortOrder = null

    name = city = country = null

    for n in l["nobelPrizes"]:
        awardYear = "," + n["awardYear"]
        category = ',"' + n["category"]["en"] + '"'
        sortOrder = "," + n["sortOrder"]

        nobelprizes_fp.write(id + awardYear + category + sortOrder)
        nobelprizes_fp.write("\n")

        awardYear = n["awardYear"]

        if "affiliations" in n.keys():
            for a in n["affiliations"]:
                if "name" in a.keys():
                    name = ',"' + a["name"]["en"] + '"'
                if "city" in a.keys():
                    city = ',"' + a["city"]["en"] + '"'
                if "country" in a.keys():
                    country = ',"' + a["country"]["en"] + '"'

                affiliations_fp.write(
                    awardYear + category + sortOrder + name + city + country
                )
                affiliations_fp.write("\n")

nobelprizes_fp.close()
affiliations_fp.close()
