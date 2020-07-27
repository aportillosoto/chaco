-- Function: sp_pedidos(integer, integer, integer, integer, character varying, integer, integer, integer, character varying)

-- DROP FUNCTION sp_pedidos(integer, integer, integer, integer, integer, character varying, integer, integer, integer, character varying);

CREATE OR REPLACE FUNCTION sp_pedidos(
    ban integer,
    vped_cod integer,
    vid_sucursal integer,
    vid_cliente integer,
    vusers_id integer,
    vped_obs character varying,
    vart_cod integer,
    vped_cant integer,
    vped_precio integer,
    vaudit character varying)
  RETURNS integer AS
$BODY$
declare ultimo integer=0;
begin 
	if ban = 1 then
		INSERT INTO pedido_ventas(
			    ped_cod, ped_fecha, ped_total, ped_estado, id_sucursal, id_cliente, users_id, ped_obs, audit)
		    VALUES ((select coalesce(max(ped_cod),0)+1 from pedido_ventas), current_date, 0, 'PENDIENTE', vid_sucursal, vid_cliente, 
			    vusers_id, vped_obs, vaudit) returning  ped_cod into ultimo; 
		
	end if;

	if ban = 4 then --agregar detalle
		INSERT INTO detalle_pventas(ped_cod, art_cod, ped_cant, ped_precio, tipo_cod, exentas, iva_5, iva_10)
		VALUES (vped_cod, vart_cod,vped_cant, vped_precio,(select tipo_cod from articulos where art_cod =vart_cod), 0, 0, 0)returning  ped_cod into ultimo;
	
		
	end if;	
	if ban = 5 then --editar detalle

		update detalle_pventas set ped_cant = vped_cant,ped_precio = vped_precio where ped_cod = vped_cod and art_cod = vart_cod returning  ped_cod into ultimo;
	
		
	end if;	
	if ban = 6 then --borrar detalle

		delete from  detalle_pventas where ped_cod = vped_cod and art_cod = vart_cod;
		ultimo = vped_cod;
	end if;			
	return ultimo;
end;
$BODY$
  LANGUAGE plpgsql;

 select sp_pedidos(5,1,0,0,0,'',4,1,200.000,'admin{::1}[EDITAR DET]'||now()) as ultimo
