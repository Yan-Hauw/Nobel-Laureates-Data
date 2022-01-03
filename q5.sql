select count(distinct awardYear)
from Laureates natural join NobelPrizes
where orgName is not null;
