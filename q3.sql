select distinct familyName from Laureates natural join NobelPrizes
where familyName is not null
group by familyName
having count(*)>=5;