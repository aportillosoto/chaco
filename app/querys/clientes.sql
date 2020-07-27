create or replace view v_clientes as
SELECT a.id_cliente, a.cli_ci_ruc, trim(a.cli_nombre ||' '||a.cli_apelli) as nombres, a.cli_direcc, a.cli_fecna, 
       a.cli_email, a.per_tel, a.cli_genero, a.cli_foto, a.lugar_resid,b.nombre_ciud, a.id_pais,c.nombre_pais,c.gentilicio,
       a.audit, a.tipo_cliente, a.created_at, a.updated_at
  FROM clientes a
  join ciudads b on a.lugar_resid = b.id_ciud
  join pais c on a.id_pais = c.id_pais;
