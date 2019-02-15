--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.10
-- Dumped by pg_dump version 11.1

-- Started on 2019-01-24 23:22:58

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
-- TOC entry 5 (class 2615 OID 16394)
-- Name: task_monitoring; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA task_monitoring;


ALTER SCHEMA task_monitoring OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 194 (class 1259 OID 32810)
-- Name: auth_assignment; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.auth_assignment (
    item_name character varying(64) NOT NULL,
    user_id character varying(64) NOT NULL,
    created_at integer
);


ALTER TABLE public.auth_assignment OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 32781)
-- Name: auth_item; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.auth_item (
    name character varying(64) NOT NULL,
    type smallint NOT NULL,
    description text,
    rule_name character varying(64),
    data bytea,
    created_at integer,
    updated_at integer
);


ALTER TABLE public.auth_item OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 32795)
-- Name: auth_item_child; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.auth_item_child (
    parent character varying(64) NOT NULL,
    child character varying(64) NOT NULL
);


ALTER TABLE public.auth_item_child OWNER TO postgres;

--
-- TOC entry 191 (class 1259 OID 32773)
-- Name: auth_rule; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.auth_rule (
    name character varying(64) NOT NULL,
    data bytea,
    created_at integer,
    updated_at integer
);


ALTER TABLE public.auth_rule OWNER TO postgres;

--
-- TOC entry 190 (class 1259 OID 32768)
-- Name: migration; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE public.migration OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 40973)
-- Name: comment; Type: TABLE; Schema: task_monitoring; Owner: postgres
--

CREATE TABLE task_monitoring.comment (
    id integer NOT NULL,
    user_comment character varying NOT NULL,
    task_id numeric NOT NULL,
    comments character varying NOT NULL,
    attachments character varying,
    created_at timestamp with time zone
);


ALTER TABLE task_monitoring.comment OWNER TO postgres;

--
-- TOC entry 195 (class 1259 OID 40971)
-- Name: comment_id_seq; Type: SEQUENCE; Schema: task_monitoring; Owner: postgres
--

CREATE SEQUENCE task_monitoring.comment_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE task_monitoring.comment_id_seq OWNER TO postgres;

--
-- TOC entry 2197 (class 0 OID 0)
-- Dependencies: 195
-- Name: comment_id_seq; Type: SEQUENCE OWNED BY; Schema: task_monitoring; Owner: postgres
--

ALTER SEQUENCE task_monitoring.comment_id_seq OWNED BY task_monitoring.comment.id;


--
-- TOC entry 189 (class 1259 OID 24578)
-- Name: task; Type: TABLE; Schema: task_monitoring; Owner: postgres
--

CREATE TABLE task_monitoring.task (
    id integer NOT NULL,
    user_from character varying NOT NULL,
    user_to character varying NOT NULL,
    remark character varying NOT NULL,
    status character varying NOT NULL,
    description character varying NOT NULL,
    date_from date NOT NULL,
    date_to date NOT NULL,
    update_at timestamp with time zone,
    create_at timestamp with time zone
);


ALTER TABLE task_monitoring.task OWNER TO postgres;

--
-- TOC entry 188 (class 1259 OID 24576)
-- Name: task_id_seq; Type: SEQUENCE; Schema: task_monitoring; Owner: postgres
--

CREATE SEQUENCE task_monitoring.task_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE task_monitoring.task_id_seq OWNER TO postgres;

--
-- TOC entry 2198 (class 0 OID 0)
-- Dependencies: 188
-- Name: task_id_seq; Type: SEQUENCE OWNED BY; Schema: task_monitoring; Owner: postgres
--

ALTER SEQUENCE task_monitoring.task_id_seq OWNED BY task_monitoring.task.id;


--
-- TOC entry 187 (class 1259 OID 16437)
-- Name: user; Type: TABLE; Schema: task_monitoring; Owner: postgres
--

CREATE TABLE task_monitoring."user" (
    id integer NOT NULL,
    nik numeric NOT NULL,
    password character varying NOT NULL,
    role character varying
);


ALTER TABLE task_monitoring."user" OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 16435)
-- Name: user_id_seq; Type: SEQUENCE; Schema: task_monitoring; Owner: postgres
--

CREATE SEQUENCE task_monitoring.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE task_monitoring.user_id_seq OWNER TO postgres;

--
-- TOC entry 2199 (class 0 OID 0)
-- Dependencies: 186
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: task_monitoring; Owner: postgres
--

ALTER SEQUENCE task_monitoring.user_id_seq OWNED BY task_monitoring."user".id;


--
-- TOC entry 2041 (class 2604 OID 40976)
-- Name: comment id; Type: DEFAULT; Schema: task_monitoring; Owner: postgres
--

ALTER TABLE ONLY task_monitoring.comment ALTER COLUMN id SET DEFAULT nextval('task_monitoring.comment_id_seq'::regclass);


--
-- TOC entry 2040 (class 2604 OID 24581)
-- Name: task id; Type: DEFAULT; Schema: task_monitoring; Owner: postgres
--

ALTER TABLE ONLY task_monitoring.task ALTER COLUMN id SET DEFAULT nextval('task_monitoring.task_id_seq'::regclass);


--
-- TOC entry 2039 (class 2604 OID 16440)
-- Name: user id; Type: DEFAULT; Schema: task_monitoring; Owner: postgres
--

ALTER TABLE ONLY task_monitoring."user" ALTER COLUMN id SET DEFAULT nextval('task_monitoring.user_id_seq'::regclass);


--
-- TOC entry 2189 (class 0 OID 32810)
-- Dependencies: 194
-- Data for Name: auth_assignment; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.auth_assignment (item_name, user_id, created_at) VALUES ('user', '4', 1547454990);
INSERT INTO public.auth_assignment (item_name, user_id, created_at) VALUES ('admin', '3', 1547455112);


--
-- TOC entry 2187 (class 0 OID 32781)
-- Dependencies: 192
-- Data for Name: auth_item; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('admin', 1, NULL, NULL, NULL, 1547454038, 1547454038);
INSERT INTO public.auth_item (name, type, description, rule_name, data, created_at, updated_at) VALUES ('user', 1, NULL, NULL, NULL, 1547454752, 1547454752);


--
-- TOC entry 2188 (class 0 OID 32795)
-- Dependencies: 193
-- Data for Name: auth_item_child; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2186 (class 0 OID 32773)
-- Dependencies: 191
-- Data for Name: auth_rule; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2185 (class 0 OID 32768)
-- Dependencies: 190
-- Data for Name: migration; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.migration (version, apply_time) VALUES ('m000000_000000_base', 1547453889);
INSERT INTO public.migration (version, apply_time) VALUES ('m140506_102106_rbac_init', 1547453989);
INSERT INTO public.migration (version, apply_time) VALUES ('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1547453989);


--
-- TOC entry 2191 (class 0 OID 40973)
-- Dependencies: 196
-- Data for Name: comment; Type: TABLE DATA; Schema: task_monitoring; Owner: postgres
--

INSERT INTO task_monitoring.comment (id, user_comment, task_id, comments, attachments, created_at) VALUES (106, '619009', 126, 'seperti ini ya', '619009Capture.jpg', '2019-01-24 15:58:02+07');
INSERT INTO task_monitoring.comment (id, user_comment, task_id, comments, attachments, created_at) VALUES (107, '619009', 78, 'asd', NULL, '2019-01-24 15:59:15+07');
INSERT INTO task_monitoring.comment (id, user_comment, task_id, comments, attachments, created_at) VALUES (108, '619008', 126, 'iya betul', NULL, '2019-01-24 16:00:58+07');


--
-- TOC entry 2184 (class 0 OID 24578)
-- Dependencies: 189
-- Data for Name: task; Type: TABLE DATA; Schema: task_monitoring; Owner: postgres
--

INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (108, '619001', '619009', 'coba', 'Done', 'coba123', '2019-01-22', '2019-01-24', '2019-01-22 10:15:21+07', NULL);
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (91, '619008', '619009', 'fix', 'Done', 'fix', '2019-01-18', '2019-01-19', '2019-01-18 16:15:15+07', '2019-01-18 16:15:00+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (123, '619009', '619008', 'mencari kandidat magang', 'Done', 'telpon 11', '2019-01-21', '2019-01-21', '2019-01-22 13:21:32+07', '2019-01-21 09:45:37+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (84, '619009', '619008', 'coba8', 'Done', 'coba8', '2019-01-18', '2019-01-19', '2019-01-18 16:20:58+07', '2019-01-18 09:59:43+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (92, '619009', '619008', 'fixx', 'Rejected', 'fixx', '2019-01-18', '2019-01-19', '2019-01-18 16:21:53+07', '2019-01-18 16:16:26+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (89, '619009', '619008', 'coba4321', 'Done', 'coba4321', '2019-01-18', '2019-01-19', '2019-01-18 16:22:11+07', '2019-01-18 11:23:10+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (83, '619009', '619008', 'coba7', 'Done', 'coba7', '2019-01-19', '2019-01-26', '2019-01-20 08:27:48+07', '2019-01-18 09:57:53+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (102, '619009', '619008', 'asd', 'Rejected', 'dsa', '2019-01-21', '2019-01-24', '2019-01-20 12:44:26+07', '2019-01-20 12:44:17+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (105, '619008', '619009', 'buat form', 'Done', 'buat form', '2019-01-24', '2019-01-30', '2019-01-20 17:30:32+07', '2019-01-20 17:30:00+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (88, '619008', '619009', '321tes', 'Done', '321tes', '2019-01-19', '2019-01-24', '2019-01-18 11:23:35+07', NULL);
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (107, '619008', '619009', '12345', 'Rejected', '54321', '2019-01-26', '2019-01-30', '2019-01-21 08:08:08+07', '2019-01-21 08:06:36+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (117, '619008', '619009', 'fix12345', 'Approved', 'coba56712344', '2019-01-24', '2019-01-26', '2019-01-23 11:38:14+07', '2019-01-23 09:08:51+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (79, '619009', '619008', 'coba3', 'Rejected', 'coba3', '2019-01-18', '2019-01-25', '2019-01-23 14:42:23+07', '2019-01-18 09:54:05+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (109, '619009', '619008', '123coba', 'Rejected', 'coboacoba', '2019-01-23', '2019-01-23', '2019-01-21 08:39:20+07', NULL);
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (81, '619009', '619008', 'coba5555', 'Approved', 'coba5', '2019-01-19', '2019-01-24', '2019-01-23 16:49:13+07', '2019-01-18 09:55:33+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (119, '619008', '619009', 'betulin gelas pecah', 'Done', 'hati hati yaa', '2019-01-21', '2019-01-23', '2019-01-21 09:03:04+07', '2019-01-21 09:01:51+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (78, '619009', '619008', 'coba44', 'Done', 'coba444', '2019-01-18', '2019-01-25', '2019-01-23 16:49:28+07', '2019-01-18 09:54:05+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (124, '619001', '619009', 'sorting data', 'Rejected', 'data karyawan dan gaji', '2019-01-21', '2019-01-21', '2019-01-21 09:47:45+07', '2019-01-21 09:46:27+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (106, '619008', '619009', '12345', 'Done', '54321', '2019-01-26', '2019-01-30', '2019-01-22 10:15:06+07', '2019-01-20 20:42:24+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (126, '619008', '619009', 'bikin kopi', 'Done', 'gulanya sedikit', '2019-01-23', '2019-01-23', '2019-01-23 16:52:55+07', '2019-01-23 16:51:05+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (116, '619008', '619009', 'cek123', 'Rejected', 'tes321', '2019-01-22', '2019-01-24', '2019-01-24 15:44:35+07', '2019-01-21 08:35:39+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (131, '619008', '619001', 'ambil barang lagi', 'Pending', 'semuanya', '2019-01-24', '2019-01-25', NULL, '2019-01-24 16:20:53+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (132, '619008', '619002', 'coba lagi', 'Pending', 'semuanya', '2019-01-24', '2019-01-25', NULL, '2019-01-24 16:21:49+07');
INSERT INTO task_monitoring.task (id, user_from, user_to, remark, status, description, date_from, date_to, update_at, create_at) VALUES (130, '619008', '619009', 'ambil barang lagii', 'Pending', 'semuanya', '2019-01-24', '2019-01-25', '2019-01-24 16:22:31+07', '2019-01-24 16:19:35+07');


--
-- TOC entry 2182 (class 0 OID 16437)
-- Dependencies: 187
-- Data for Name: user; Type: TABLE DATA; Schema: task_monitoring; Owner: postgres
--

INSERT INTO task_monitoring."user" (id, nik, password, role) VALUES (3, 619008, '12345', 'admin');
INSERT INTO task_monitoring."user" (id, nik, password, role) VALUES (4, 619009, '12345', 'user');
INSERT INTO task_monitoring."user" (id, nik, password, role) VALUES (6, 619001, '12345', 'user');
INSERT INTO task_monitoring."user" (id, nik, password, role) VALUES (7, 619002, '12345', 'user');


--
-- TOC entry 2200 (class 0 OID 0)
-- Dependencies: 195
-- Name: comment_id_seq; Type: SEQUENCE SET; Schema: task_monitoring; Owner: postgres
--

SELECT pg_catalog.setval('task_monitoring.comment_id_seq', 108, true);


--
-- TOC entry 2201 (class 0 OID 0)
-- Dependencies: 188
-- Name: task_id_seq; Type: SEQUENCE SET; Schema: task_monitoring; Owner: postgres
--

SELECT pg_catalog.setval('task_monitoring.task_id_seq', 132, true);


--
-- TOC entry 2202 (class 0 OID 0)
-- Dependencies: 186
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: task_monitoring; Owner: postgres
--

SELECT pg_catalog.setval('task_monitoring.user_id_seq', 7, true);


--
-- TOC entry 2056 (class 2606 OID 32814)
-- Name: auth_assignment auth_assignment_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auth_assignment
    ADD CONSTRAINT auth_assignment_pkey PRIMARY KEY (item_name, user_id);


--
-- TOC entry 2054 (class 2606 OID 32799)
-- Name: auth_item_child auth_item_child_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auth_item_child
    ADD CONSTRAINT auth_item_child_pkey PRIMARY KEY (parent, child);


--
-- TOC entry 2051 (class 2606 OID 32788)
-- Name: auth_item auth_item_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auth_item
    ADD CONSTRAINT auth_item_pkey PRIMARY KEY (name);


--
-- TOC entry 2049 (class 2606 OID 32780)
-- Name: auth_rule auth_rule_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auth_rule
    ADD CONSTRAINT auth_rule_pkey PRIMARY KEY (name);


--
-- TOC entry 2047 (class 2606 OID 32772)
-- Name: migration migration_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);


--
-- TOC entry 2059 (class 2606 OID 40981)
-- Name: comment comment_pkey; Type: CONSTRAINT; Schema: task_monitoring; Owner: postgres
--

ALTER TABLE ONLY task_monitoring.comment
    ADD CONSTRAINT comment_pkey PRIMARY KEY (id);


--
-- TOC entry 2045 (class 2606 OID 24586)
-- Name: task task_pkey; Type: CONSTRAINT; Schema: task_monitoring; Owner: postgres
--

ALTER TABLE ONLY task_monitoring.task
    ADD CONSTRAINT task_pkey PRIMARY KEY (id);


--
-- TOC entry 2043 (class 2606 OID 16445)
-- Name: user user_pkey; Type: CONSTRAINT; Schema: task_monitoring; Owner: postgres
--

ALTER TABLE ONLY task_monitoring."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- TOC entry 2057 (class 1259 OID 32820)
-- Name: auth_assignment_user_id_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX auth_assignment_user_id_idx ON public.auth_assignment USING btree (user_id);


--
-- TOC entry 2052 (class 1259 OID 32794)
-- Name: idx-auth_item-type; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX "idx-auth_item-type" ON public.auth_item USING btree (type);


--
-- TOC entry 2063 (class 2606 OID 32815)
-- Name: auth_assignment auth_assignment_item_name_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auth_assignment
    ADD CONSTRAINT auth_assignment_item_name_fkey FOREIGN KEY (item_name) REFERENCES public.auth_item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2062 (class 2606 OID 32805)
-- Name: auth_item_child auth_item_child_child_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auth_item_child
    ADD CONSTRAINT auth_item_child_child_fkey FOREIGN KEY (child) REFERENCES public.auth_item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2061 (class 2606 OID 32800)
-- Name: auth_item_child auth_item_child_parent_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auth_item_child
    ADD CONSTRAINT auth_item_child_parent_fkey FOREIGN KEY (parent) REFERENCES public.auth_item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 2060 (class 2606 OID 32789)
-- Name: auth_item auth_item_rule_name_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.auth_item
    ADD CONSTRAINT auth_item_rule_name_fkey FOREIGN KEY (rule_name) REFERENCES public.auth_rule(name) ON UPDATE CASCADE ON DELETE SET NULL;


-- Completed on 2019-01-24 23:22:59

--
-- PostgreSQL database dump complete
--

