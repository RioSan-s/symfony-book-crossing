--
-- PostgreSQL database dump
--

-- Dumped from database version 14.2
-- Dumped by pg_dump version 14.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE IF EXISTS book_crossing;
--
-- Name: book_crossing; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE book_crossing WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Russian_Russia.1251';


ALTER DATABASE book_crossing OWNER TO postgres;

\connect book_crossing

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: act_of_giving; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.act_of_giving (
    id integer NOT NULL,
    book_id integer NOT NULL,
    count integer NOT NULL,
    participant_id integer NOT NULL
);


ALTER TABLE public.act_of_giving OWNER TO postgres;

--
-- Name: act_of_taking; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.act_of_taking (
    id integer NOT NULL,
    book_id integer NOT NULL,
    count integer NOT NULL,
    participant_id integer NOT NULL
);


ALTER TABLE public.act_of_taking OWNER TO postgres;

--
-- Name: act_of_taking_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.act_of_taking ALTER COLUMN id ADD GENERATED BY DEFAULT AS IDENTITY (
    SEQUENCE NAME public.act_of_taking_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: acts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.acts (
    id integer NOT NULL,
    book_id integer NOT NULL,
    count integer NOT NULL,
    participant_id integer NOT NULL
);


ALTER TABLE public.acts OWNER TO postgres;

--
-- Name: acts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.acts_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.acts_id_seq OWNER TO postgres;

--
-- Name: acts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.acts_id_seq OWNED BY public.acts.id;


--
-- Name: admin; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.admin (
    id integer NOT NULL,
    point_id integer NOT NULL,
    salary integer NOT NULL,
    login character varying(25) NOT NULL,
    password character varying(200) NOT NULL
);


ALTER TABLE public.admin OWNER TO postgres;

--
-- Name: book_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.book_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.book_id_seq OWNER TO postgres;

--
-- Name: books; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.books (
    id integer DEFAULT nextval('public.book_id_seq'::regclass) NOT NULL,
    title character varying(250) NOT NULL,
    author character varying(250) NOT NULL,
    publishing_house character varying(250) NOT NULL,
    point_id integer NOT NULL,
    year_of_publication date
);


ALTER TABLE public.books OWNER TO postgres;

--
-- Name: currency; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.currency (
    id integer NOT NULL,
    code character varying(3) NOT NULL,
    name character varying(3) NOT NULL,
    description character varying(255) NOT NULL
);


ALTER TABLE public.currency OWNER TO postgres;

--
-- Name: currency_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.currency ALTER COLUMN id ADD GENERATED BY DEFAULT AS IDENTITY (
    SEQUENCE NAME public.currency_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO postgres;

--
-- Name: participants; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.participants (
    id integer NOT NULL,
    email character varying(50) NOT NULL
);


ALTER TABLE public.participants OWNER TO postgres;

--
-- Name: points; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.points (
    id integer NOT NULL,
    phone_number character varying(20) NOT NULL,
    address character varying(250) NOT NULL,
    start_time time without time zone NOT NULL,
    end_time time without time zone NOT NULL
);


ALTER TABLE public.points OWNER TO postgres;

--
-- Name: points_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.points ALTER COLUMN id ADD GENERATED BY DEFAULT AS IDENTITY (
    SEQUENCE NAME public.points_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: purchase_prices; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.purchase_prices (
    book_id integer,
    date timestamp without time zone,
    price integer,
    currency_id integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE public.purchase_prices OWNER TO postgres;

--
-- Name: purchase_prices_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.purchase_prices_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.purchase_prices_id_seq OWNER TO postgres;

--
-- Name: purchase_prices_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.purchase_prices_id_seq OWNED BY public.purchase_prices.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    fio character varying(250) NOT NULL,
    phone_number character varying(35) NOT NULL,
    date_of_birth date NOT NULL,
    type character varying(30) NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: acts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acts ALTER COLUMN id SET DEFAULT nextval('public.acts_id_seq'::regclass);


--
-- Name: purchase_prices id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.purchase_prices ALTER COLUMN id SET DEFAULT nextval('public.purchase_prices_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: act_of_giving; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.act_of_giving VALUES (1, 1, 1, 1);
INSERT INTO public.act_of_giving VALUES (2, 2, 1, 4);
INSERT INTO public.act_of_giving VALUES (3, 3, 1, 2);
INSERT INTO public.act_of_giving VALUES (4, 4, 1, 3);
INSERT INTO public.act_of_giving VALUES (5, 5, 1, 5);


--
-- Data for Name: act_of_taking; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.act_of_taking VALUES (30, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (31, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (32, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (33, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (34, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (35, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (36, 1, 3, 4);
INSERT INTO public.act_of_taking VALUES (37, 5, 1, 1);
INSERT INTO public.act_of_taking VALUES (38, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (39, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (43, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (40, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (41, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (44, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (46, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (48, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (50, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (54, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (56, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (58, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (60, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (72, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (73, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (74, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (75, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (76, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (77, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (79, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (80, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (81, 5, 1, 5);
INSERT INTO public.act_of_taking VALUES (96, 1, 4, 3);
INSERT INTO public.act_of_taking VALUES (97, 4, 2, 1);
INSERT INTO public.act_of_taking VALUES (6, 4, 1, 7);
INSERT INTO public.act_of_taking VALUES (7, 3, 1, 5);
INSERT INTO public.act_of_taking VALUES (8, 1, 1, 1);
INSERT INTO public.act_of_taking VALUES (29, 1, 4, 1);


--
-- Data for Name: acts; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.acts VALUES (1, 1, 1, 1);
INSERT INTO public.acts VALUES (2, 2, 1, 4);
INSERT INTO public.acts VALUES (3, 3, 1, 2);
INSERT INTO public.acts VALUES (4, 4, 1, 3);
INSERT INTO public.acts VALUES (5, 5, 1, 5);
INSERT INTO public.acts VALUES (6, 4, 1, 7);
INSERT INTO public.acts VALUES (7, 3, 1, 5);
INSERT INTO public.acts VALUES (8, 1, 1, 1);
INSERT INTO public.acts VALUES (43, 5, 1, 5);
INSERT INTO public.acts VALUES (40, 5, 1, 5);
INSERT INTO public.acts VALUES (41, 5, 1, 5);
INSERT INTO public.acts VALUES (44, 5, 1, 5);


--
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.admin VALUES (8, 1, 25000, 'admin1', '$2y$10$/PMscuC3phf6f6k1UdKkk.F1HAkgKF./oNrOrLXuGwkwSHVwReZ1q');
INSERT INTO public.admin VALUES (9, 2, 30000, 'admin2', '$2y$10$o7M73Yobl0IiYdAFzRWri.kFHi5a1nXIA/Sl5JkN54ep0oULDbV4S');
INSERT INTO public.admin VALUES (10, 1, 25000, 'admin3', '$2y$10$.mNXwd0pnLOxg2y41oyuqeTiOfwdJtGJdhg9RoCxZpSZno0orQjzG');
INSERT INTO public.admin VALUES (11, 3, 10000, 'admin4', '$2y$10$PY9utD1nS6oZOwZJPevE1uMe8H9texgfaiJvG33lW4ZOzCaDM/bqS');
INSERT INTO public.admin VALUES (12, 3, 10000, 'admin5', '$2y$10$ULC5LeqakqzJ9kYzIUwSxO2F.lAJ16NdD/MXSHr30huI6MUPKYnzu');


--
-- Data for Name: books; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.books VALUES (1, 'Мастер и Маргарита', 'Михаил Булгаков', 'Эксмо', 1, '2021-01-01');
INSERT INTO public.books VALUES (2, 'Мёртвые души', 'Николай Гоголь', 'АСТ', 3, '2016-01-01');
INSERT INTO public.books VALUES (3, 'Евгений Онегин', 'Александр Пушкин', 'Эксмо', 2, '2016-01-01');
INSERT INTO public.books VALUES (4, 'Собака Баскервилей', 'Артур Конан Дойль', 'АСТ', 2, '2020-01-01');
INSERT INTO public.books VALUES (5, 'Старик и море', 'Эрнест Хемингуэй', 'Эксмо', 1, '2002-01-01');


--
-- Data for Name: currency; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.currency VALUES (1, '643', 'RUB', 'Рубль');


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.doctrine_migration_versions VALUES ('NonEfTech\BookCrossing\Migrations\Version20220322163952', '2022-03-22 16:40:49', 53);


--
-- Data for Name: participants; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.participants VALUES (1, 'irina2888@rambler.ru');
INSERT INTO public.participants VALUES (2, 'elizaveta03031967@gmail.com');
INSERT INTO public.participants VALUES (3, 'marianna1984@ya.ru');
INSERT INTO public.participants VALUES (4, 'margarita1990@hotmail.com');
INSERT INTO public.participants VALUES (5, 'antonina1965@mail.ru');
INSERT INTO public.participants VALUES (6, 'konstantin1983@outlook.com');
INSERT INTO public.participants VALUES (7, 'maksim16@outlook.com');


--
-- Data for Name: points; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.points VALUES (1, '+7 (962) 448-19-25', 'Россия, г. Уссурийск, Зеленая ул., д. 13 кв.200', '09:00:00', '18:00:00');
INSERT INTO public.points VALUES (2, '+7 (963) 757-16-90', 'Россия, г. Уфа, Почтовая ул., д. 11 кв.34', '10:00:00', '20:00:00');
INSERT INTO public.points VALUES (3, '+7 (919) 961-24-65', 'Россия, г. Абакан, Пушкина ул., д. 6 кв.136', '12:00:00', '16:00:00');
INSERT INTO public.points VALUES (4, '+7 (902) 685-24-76', 'Россия, г. Бузулук, Аналик ул., д. 4 кв.126', '08:00:00', '20:00:00');
INSERT INTO public.points VALUES (5, '+7 (909) 961-24-65', 'Россия, г. Нижний Новгород, Березовская ул., д. 14 кв.113', '10:00:00', '19:00:00');


--
-- Data for Name: purchase_prices; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.purchase_prices VALUES (1, '2021-08-30 00:00:00', 28940, 1, 16);
INSERT INTO public.purchase_prices VALUES (2, '2021-04-09 00:00:00', 14252, 1, 17);
INSERT INTO public.purchase_prices VALUES (3, '2021-07-27 00:00:00', 43000, 1, 18);
INSERT INTO public.purchase_prices VALUES (4, '2021-11-10 00:00:00', 12000, 1, 19);
INSERT INTO public.purchase_prices VALUES (5, '2021-10-31 00:00:00', 73200, 1, 20);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.users VALUES (1, 'Хигир Ирина Кузьминовна', '+7 (983) 604-51-60', '1973-04-15', 'participant');
INSERT INTO public.users VALUES (2, 'Курневича Елизавета Ефимовна', '+7 (953) 499-40-73', '1967-03-03', 'participant');
INSERT INTO public.users VALUES (3, 'Ясинская Марианна Климентьевна', '+7 (968) 528-41-17', '1984-12-10', 'participant');
INSERT INTO public.users VALUES (4, 'Булыгина Маргарита Никаноровна', '+7 (961) 179-12-24', '1990-06-25', 'participant');
INSERT INTO public.users VALUES (5, 'Лысова Антонина Егоровна', '+7 (929) 698-21-43', '1998-12-25', 'participant');
INSERT INTO public.users VALUES (6, 'Стрельцов Константин Юринович', '+7 (966) 211-77-49', '1983-03-02', 'participant');
INSERT INTO public.users VALUES (7, 'Бесфамильнов Максим Адамович', '+7 (963) 868-93-56', '1983-05-03', 'participant');
INSERT INTO public.users VALUES (8, 'Другаков Николай Егорович', '+7 (963) 974-86-15', '1972-05-24', 'admin');
INSERT INTO public.users VALUES (9, 'Вельдина Катерина Захаровна', '+7 (967) 674-75-89', '1978-09-03', 'admin');
INSERT INTO public.users VALUES (10, 'Болтунова Василиса', '+7 (919) 961-24-65', '1974-04-22', 'admin');
INSERT INTO public.users VALUES (11, 'Ковалевская Сюзанна Сергеевна', '+7 (974) 381-61-51', '1980-09-02', 'admin');
INSERT INTO public.users VALUES (12, 'Русских Виталий Гаврннлович', '+7 (997) 958-51-62', '1989-09-05', 'admin');


--
-- Name: act_of_taking_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.act_of_taking_id_seq', 97, true);


--
-- Name: acts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.acts_id_seq', 44, true);


--
-- Name: book_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.book_id_seq', 5, true);


--
-- Name: currency_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.currency_id_seq', 1, true);


--
-- Name: points_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.points_id_seq', 5, true);


--
-- Name: purchase_prices_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.purchase_prices_id_seq', 20, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 12, true);


--
-- Name: act_of_giving act_of_giving_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.act_of_giving
    ADD CONSTRAINT act_of_giving_pk PRIMARY KEY (id);


--
-- Name: act_of_taking act_of_taking_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.act_of_taking
    ADD CONSTRAINT act_of_taking_pk PRIMARY KEY (id);


--
-- Name: acts acts_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.acts
    ADD CONSTRAINT acts_pk PRIMARY KEY (id);


--
-- Name: admin admin_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pk PRIMARY KEY (id);


--
-- Name: books books_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.books
    ADD CONSTRAINT books_pk PRIMARY KEY (id);


--
-- Name: currency currency_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.currency
    ADD CONSTRAINT currency_pk PRIMARY KEY (id);


--
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- Name: participants participants_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.participants
    ADD CONSTRAINT participants_pk PRIMARY KEY (id);


--
-- Name: points points_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.points
    ADD CONSTRAINT points_pk PRIMARY KEY (id);


--
-- Name: purchase_prices purchase_prices_pk; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.purchase_prices
    ADD CONSTRAINT purchase_prices_pk PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: act_of_giving_book_id_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX act_of_giving_book_id_idx ON public.act_of_giving USING btree (book_id);


--
-- Name: act_of_giving_participant_id_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX act_of_giving_participant_id_idx ON public.act_of_giving USING btree (participant_id);


--
-- Name: act_of_taking_book_id_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX act_of_taking_book_id_idx ON public.act_of_taking USING btree (book_id);


--
-- Name: act_of_taking_participant_id_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX act_of_taking_participant_id_idx ON public.act_of_taking USING btree (participant_id);


--
-- Name: acts_book_id_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX acts_book_id_idx ON public.acts USING btree (book_id);


--
-- Name: acts_participant_id_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX acts_participant_id_idx ON public.acts USING btree (participant_id);


--
-- Name: admin_login_unq; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX admin_login_unq ON public.admin USING btree (login);


--
-- Name: admin_point_id_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX admin_point_id_idx ON public.admin USING btree (point_id);


--
-- Name: books_author_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX books_author_idx ON public.books USING btree (author);


--
-- Name: books_point_id_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX books_point_id_idx ON public.books USING btree (point_id);


--
-- Name: books_publishing_house_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX books_publishing_house_idx ON public.books USING btree (publishing_house);


--
-- Name: books_title_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX books_title_idx ON public.books USING btree (title);


--
-- Name: currency_code_unq; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX currency_code_unq ON public.currency USING btree (code);


--
-- Name: currency_id_uindex; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX currency_id_uindex ON public.currency USING btree (id);


--
-- Name: currency_name_unq; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX currency_name_unq ON public.currency USING btree (name);


--
-- Name: participants_email_unq; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX participants_email_unq ON public.participants USING btree (email);


--
-- Name: points_address_unq; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX points_address_unq ON public.points USING btree (address);


--
-- Name: points_end_time_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX points_end_time_idx ON public.points USING btree (end_time);


--
-- Name: points_phone_number_unq; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX points_phone_number_unq ON public.points USING btree (phone_number);


--
-- Name: points_start_time_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX points_start_time_idx ON public.points USING btree (start_time);


--
-- Name: users_date_of_birth_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX users_date_of_birth_idx ON public.users USING btree (date_of_birth);


--
-- Name: users_fio_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX users_fio_idx ON public.users USING btree (fio);


--
-- Name: users_phone_number_unq; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX users_phone_number_unq ON public.users USING btree (phone_number);


--
-- Name: users_type_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX users_type_idx ON public.users USING btree (type);


--
-- Name: act_of_giving act_of_giving_book_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.act_of_giving
    ADD CONSTRAINT act_of_giving_book_id_fk FOREIGN KEY (book_id) REFERENCES public.books(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: act_of_giving act_of_giving_participant_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.act_of_giving
    ADD CONSTRAINT act_of_giving_participant_id_fk FOREIGN KEY (participant_id) REFERENCES public.participants(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: act_of_taking act_of_taking_book_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.act_of_taking
    ADD CONSTRAINT act_of_taking_book_id_fk FOREIGN KEY (book_id) REFERENCES public.books(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: act_of_taking act_of_taking_participant_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.act_of_taking
    ADD CONSTRAINT act_of_taking_participant_id_fk FOREIGN KEY (participant_id) REFERENCES public.participants(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: admin admins_point_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admins_point_id_fk FOREIGN KEY (point_id) REFERENCES public.points(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: books books_point_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.books
    ADD CONSTRAINT books_point_id_fk FOREIGN KEY (point_id) REFERENCES public.points(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: purchase_prices purchase_prices_books_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.purchase_prices
    ADD CONSTRAINT purchase_prices_books_id_fk FOREIGN KEY (book_id) REFERENCES public.books(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

