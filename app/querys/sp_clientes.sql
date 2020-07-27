create or replace function sp_clientessp_clientes(ban integer,vid_cliente integer, vcli_ci_ruc varchar, vcli_nombre varchar, vcli_apelli varchar, 
vcli_direcc varchar, vcli_fecna date, vcli_email varchar, vper_tel varchar, vcli_genero genero, vcli_foto varchar, vlugar_resid integer, vid_pais integer, vaudit varchar, vtipo_cliente tipo_cliente)
returns integer as
$$
declare ultimo integer;
begin
	if ban = 1 then
		INSERT INTO clientes(id_cliente, cli_ci_ruc, cli_nombre, cli_apelli, cli_direcc, cli_fecna, cli_email, per_tel, cli_genero, cli_foto, lugar_resid, id_pais, audit, tipo_cliente)
		    VALUES ((select coalesce(max(id_cliente),0)+1 from clientes),vcli_ci_ruc, vcli_nombre, vcli_apelli, vcli_direcc, vcli_fecna, vcli_email, vper_tel, vcli_genero, vcli_foto, vlugar_resid, vid_pais, vaudit, vtipo_cliente)returning  id_cliente into ultimo; 	
	end if;
	return ultimo;
end;
$$
language plpgsql;


select sp_clientes(1,0, '123', 'jose', 'perez', null, null,null, null, null, null, 0, 0, 'aa', 'FISICA');