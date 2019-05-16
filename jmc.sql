CREATE TABLE public.collector
(
    id character varying(100) COLLATE pg_catalog."default" NOT NULL,
    apitoken text COLLATE pg_catalog."default" NOT NULL,
    url text COLLATE pg_catalog."default" NOT NULL,
    primarycollector boolean,
    CONSTRAINT unq_id UNIQUE (id)

)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.collector
    OWNER to jupiter;

GRANT ALL ON TABLE public.collector TO jupiter;



CREATE TABLE public.config
(
    settingname character varying(50) COLLATE pg_catalog."default" NOT NULL,
    settingvalue text COLLATE pg_catalog."default"
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.config
    OWNER to jupiter;



CREATE TABLE public.jmcuser
(
    id integer NOT NULL DEFAULT nextval('user_id_seq'::regclass),
    username character varying(100) COLLATE pg_catalog."default" NOT NULL,
    password text COLLATE pg_catalog."default" NOT NULL,
    firstname character varying(55) COLLATE pg_catalog."default",
    lastname character varying(55) COLLATE pg_catalog."default",
    CONSTRAINT user_pkey PRIMARY KEY (id),
    CONSTRAINT unq_username UNIQUE (username)

)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.jmcuser
    OWNER to jupiter;