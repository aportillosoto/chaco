-- View: v_clientes

-- DROP VIEW v_clientes;

CREATE OR REPLACE VIEW v_clientes AS 
 SELECT a.id_cliente,
    a.cli_ci_ruc,
    btrim((a.cli_nombre::text || ' '::text) || a.cli_apelli::text) AS nombres,
    a.cli_direcc,
    a.cli_fecna,
    a.cli_email,
    a.cli_tel,
    a.cli_genero,
    a.cli_foto,
    a.lugar_resid,
    b.nombre_ciud,
    a.id_pais,
    c.nombre_pais,
    c.gentilicio,
    a.audit,
    a.tipo_cliente,
    a.created_at,
    a.updated_at
   FROM clientes a
     JOIN ciudads b ON a.lugar_resid = b.id_ciud
     JOIN pais c ON a.id_pais = c.id_pais;

ALTER TABLE v_clientes
  OWNER TO postgres;
