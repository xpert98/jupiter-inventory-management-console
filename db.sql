SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';

SET default_tablespace = '';

SET default_with_oids = false;

CREATE TABLE public.collector (
    id character varying(100) NOT NULL,
    apitoken text NOT NULL,
    url text NOT NULL,
    primarycollector boolean
);

CREATE TABLE public.config (
    settingname character varying(50) NOT NULL,
    settingvalue text
);

CREATE TABLE public.jmcuser (
    id integer NOT NULL,
    username character varying(100) NOT NULL,
    password text NOT NULL,
    firstname character varying(55),
    lastname character varying(55)
);

CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE public.user_id_seq OWNED BY public.jmcuser.id;

ALTER TABLE ONLY public.jmcuser ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);

ALTER TABLE ONLY public.collector
    ADD CONSTRAINT unq_id UNIQUE (id);

ALTER TABLE ONLY public.jmcuser
    ADD CONSTRAINT unq_username UNIQUE (username);

ALTER TABLE ONLY public.jmcuser
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);