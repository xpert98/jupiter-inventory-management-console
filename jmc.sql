--
-- PostgreSQL database dump
--

-- Dumped from database version 10.7
-- Dumped by pg_dump version 10.7

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: collector; Type: TABLE; Schema: public; Owner: jupiter
--

CREATE TABLE public.collector (
    id character varying(100) NOT NULL,
    apitoken text NOT NULL,
    url text NOT NULL,
    primarycollector boolean
);


ALTER TABLE public.collector OWNER TO jupiter;

--
-- Name: config; Type: TABLE; Schema: public; Owner: jupiter
--

CREATE TABLE public.config (
    settingname character varying(50) NOT NULL,
    settingvalue text
);


ALTER TABLE public.config OWNER TO jupiter;

--
-- Name: jmcuser; Type: TABLE; Schema: public; Owner: jupiter
--

CREATE TABLE public.jmcuser (
    id integer NOT NULL,
    username character varying(100) NOT NULL,
    password text NOT NULL,
    firstname character varying(55),
    lastname character varying(55)
);


ALTER TABLE public.jmcuser OWNER TO jupiter;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: jupiter
--

CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO jupiter;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: jupiter
--

ALTER SEQUENCE public.user_id_seq OWNED BY public.jmcuser.id;


--
-- Name: jmcuser id; Type: DEFAULT; Schema: public; Owner: jupiter
--

ALTER TABLE ONLY public.jmcuser ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);



--
-- Data for Name: config; Type: TABLE DATA; Schema: public; Owner: jupiter
--

COPY public.config (settingname, settingvalue) FROM stdin;
CIS_URL	
CIS_TOKEN	
FORTIFY_URL	
FORTIFY_USERNAME	
FORTIFY_PASSWORD	
\.


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: jupiter
--

SELECT pg_catalog.setval('public.user_id_seq', 6, true);


--
-- Name: collector unq_id; Type: CONSTRAINT; Schema: public; Owner: jupiter
--

ALTER TABLE ONLY public.collector
    ADD CONSTRAINT unq_id UNIQUE (id);


--
-- Name: jmcuser unq_username; Type: CONSTRAINT; Schema: public; Owner: jupiter
--

ALTER TABLE ONLY public.jmcuser
    ADD CONSTRAINT unq_username UNIQUE (username);


--
-- Name: jmcuser user_pkey; Type: CONSTRAINT; Schema: public; Owner: jupiter
--

ALTER TABLE ONLY public.jmcuser
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

