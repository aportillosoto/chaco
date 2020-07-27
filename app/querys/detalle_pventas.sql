create or replace view v_detalle_pventas as
SELECT a.ped_cod, a.art_cod,b.art_descri, a.ped_cant, a.ped_precio,(a.ped_cant * a.ped_precio) as subtotal, a.tipo_cod,c.tipo_descri, a.exentas, a.iva_5, a.iva_10
  FROM detalle_pventas a
  join articulos b on a.art_cod = b.art_cod
  join tipo_impuestos c on a.tipo_cod=c.tipo_cod;
