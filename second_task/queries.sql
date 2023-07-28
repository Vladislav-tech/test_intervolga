DELETE FROM categories
    WHERE id NOT IN (SELECT DISTINCT category_id FROM products);

-- Удалить товары без наличия
DELETE FROM products
    WHERE id NOT IN (SELECT DISTINCT product_id FROM availabilities);

-- Удалить склады без товаров
DELETE FROM stocks
    WHERE id NOT IN (SELECT DISTINCT stock_id FROM availabilities);