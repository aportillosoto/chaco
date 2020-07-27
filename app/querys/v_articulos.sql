create or replace view v_articulos as
SELECT a.art_cod, a.tip_cod,b.tip_descri, a.art_descri, a.art_precioc, a.art_preciov, a.tipo_cod, c.tipo_descri,c.tipo_porcen,
       a.art_img
  FROM articulos a
  join tipo_articulos b on a.tip_cod = b.tip_cod
  join tipo_impuestos c on a.tipo_cod = c.tipo_cod
