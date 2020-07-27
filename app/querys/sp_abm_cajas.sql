
CREATE OR REPLACE FUNCTION sp_abm_cajas(
    ban integer,
    vid_caja integer,
    vcaja_nomb character varying,
    vid_sucursal integer)
  RETURNS void AS
$BODY$

begin

case  

when ban=1 then

	INSERT INTO cajas(id_caja,id_sucursal,caja_nomb) 
	VALUES((select coalesce(max(id_caja),0)+1 from cajas where id_sucursal =vid_sucursal),vid_sucursal,trim(upper(vcaja_nomb)));

when ban=2 then

	UPDATE cajas SET caja_nomb=trim(upper(vcaja_nomb)) WHERE id_caja=vid_caja and id_sucursal =vid_sucursal;

when ban=3 then

	DELETE FROM cajas WHERE id_caja=vid_caja and id_sucursal =vid_sucursal;
	
end case;

end;

$BODY$
  LANGUAGE plpgsql;
