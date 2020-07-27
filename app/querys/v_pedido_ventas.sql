create or replace view v_pedido_ventas as
SELECT a.ped_cod, a.ped_fecha, a.ped_total, a.ped_estado, a.id_sucursal,b.suc_nombre, a.id_cliente,c.cli_ci_ruc,trim(c.cli_nombre||' '||c.cli_apelli) as cliente, 
  a.users_id,d.username, a.ped_obs, a.audit
  FROM pedido_ventas a
  join sucursales b on a.id_sucursal = b.id_sucursal
  join clientes c on a.id_cliente = c.id_cliente
  join users d on a.users_id = d.id;


select * from v_pedido_ventas