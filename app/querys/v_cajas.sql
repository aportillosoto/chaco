create view v_cajas as
SELECT a.id_caja, a.id_sucursal,b.suc_nombre, a.caja_nomb
  FROM cajas a
  join sucursales b on a.id_sucursal = b.id_sucursal;
