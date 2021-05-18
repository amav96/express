SELECT co.id,co.home_address,p.postal_code, l.locate, pro.province, c.country ,
MATCH (p.postal_code) 
AGAINST ('11800' IN BOOLEAN MODE) AS relevanceCP,
MATCH (pro.province) 
AGAINST ('11800' IN BOOLEAN MODE) AS relevanceProvince,
MATCH (l.locate) 
AGAINST ('11800' IN BOOLEAN MODE) AS relevanceLocate,
MATCH (c.country) 
AGAINST ('11800' IN BOOLEAN MODE) AS relevanceCountry
FROM postal_code p
INNER JOIN localities l ON p.postal_code = l.postal_code
INNER JOIN province pro ON l.id_province = pro.id
INNER JOIN country c ON pro.id_country = c.id
INNER JOIN coverage co ON co.postal_code = p.postal_code
where(
MATCH (p.postal_code) 
AGAINST ('11800' IN BOOLEAN MODE) 
OR
MATCH (pro.province) 
AGAINST ('11800' IN BOOLEAN MODE) 
OR
MATCH (l.locate) 
AGAINST ('11800' IN BOOLEAN MODE) 
OR
MATCH (c.country) 
AGAINST ('11800 ' IN BOOLEAN MODE) 
)
GROUP BY co.id ORDER BY relevanceProvince DESC, relevanceLocate DESC,
relevanceCP DESC,  relevanceCountry DESC
