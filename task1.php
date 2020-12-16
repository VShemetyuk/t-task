
SELECT u.name,
COUNT(p.user_id) 'к-во номеров'
FROM users u
INNER JOIN phone_numbers p ON u.id = p.user_id
WHERE u.gender = 2 AND (YEAR(CURDATE()) - YEAR(FROM_UNIXTIME(u.birth_date))) BETWEEN 18 AND 22 GROUP BY u.id
