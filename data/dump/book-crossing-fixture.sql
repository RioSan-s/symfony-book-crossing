--
-- PostgreSQL database dump
--

-- Dumped from database version 12.9 (Ubuntu 12.9-0ubuntu0.20.04.1)
-- Dumped by pg_dump version 12.9 (Ubuntu 12.9-0ubuntu0.20.04.1)

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

--
-- Data for Name: points; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.points (id, phone_number, start_time, end_time, country, city, street, home, flat) FROM stdin;
4	+7 (902) 685-24-76	08:00:00	20:00:00	Россия	Бузулук	Аналик	4	126
1	+7 (962) 448-19-25	09:00:00	18:00:00	Россия	Уссурийск	Зеленая	13	200
5	+7 (909) 961-24-65	10:00:00	19:00:00	Россия	Нижний Новгород	Березовская	14	113
3	+7 (919) 961-24-65	12:00:00	16:00:00	Россия	Абакан	Пушкина	6	136
2	+7 (963) 757-16-90	10:00:00	20:00:00	Россия	Уфа	Почтовая	11	34
\.


--
-- Data for Name: publication_house; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.publication_house (id, name_of_publication_house, year_of_creation, owner_of_publication_house) FROM stdin;
1	Эксмо	1991-01-01	Александр Красовицкий
2	АСТ	1990-01-01	Олег Новиков
\.


--
-- Data for Name: books; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.books (id, title, author, publishing_house_id, point_id, year_of_publication) FROM stdin;
5	Старик и море	Эрнест Хемингуэй	1	1	2002-01-01
4	Собака Баскервилей	Артур Конан Дойль	2	2	2020-01-01
2	Мёртвые души	Николай Гоголь	2	3	2016-01-01
3	Евгений Онегин	Александр Пушкин	1	2	2016-01-01
1	Мастер и Маргарита	Михаил Булгаков	1	1	2021-01-01
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, fio, phone_number, date_of_birth, type) FROM stdin;
1	Хигир Ирина Кузьминовна	+7 (983) 604-51-60	1973-04-15	participant
2	Курневича Елизавета Ефимовна	+7 (953) 499-40-73	1967-03-03	participant
3	Ясинская Марианна Климентьевна	+7 (968) 528-41-17	1984-12-10	participant
4	Булыгина Маргарита Никаноровна	+7 (961) 179-12-24	1990-06-25	participant
5	Лысова Антонина Егоровна	+7 (929) 698-21-43	1998-12-25	participant
6	Стрельцов Константин Юринович	+7 (966) 211-77-49	1983-03-02	participant
7	Бесфамильнов Максим Адамович	+7 (963) 868-93-56	1983-05-03	participant
8	Другаков Николай Егорович	+7 (963) 974-86-15	1972-05-24	admin
9	Вельдина Катерина Захаровна	+7 (967) 674-75-89	1978-09-03	admin
10	Болтунова Василиса	+7 (919) 961-24-65	1974-04-22	admin
11	Ковалевская Сюзанна Сергеевна	+7 (974) 381-61-51	1980-09-02	admin
12	Русских Виталий Гаврннлович	+7 (997) 958-51-62	1989-09-05	admin
\.


--
-- Data for Name: participants; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.participants (id, email) FROM stdin;
1	irina2888@rambler.ru
2	elizaveta03031967@gmail.com
3	marianna1984@ya.ru
4	margarita1990@hotmail.com
5	antonina1965@mail.ru
6	konstantin1983@outlook.com
7	maksim16@outlook.com
\.


--
-- Data for Name: act_of_giving; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.act_of_giving (id, book_id, count, participant_id) FROM stdin;
1	1	1	1
2	2	1	4
3	3	1	2
4	4	1	3
5	5	1	5
\.


--
-- Data for Name: act_of_taking; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.act_of_taking (id, book_id, count, participant_id) FROM stdin;
30	5	1	5
31	5	1	5
32	5	1	5
33	5	1	5
34	5	1	5
35	5	1	5
36	1	3	4
37	5	1	1
38	5	1	5
39	5	1	5
43	5	1	5
40	5	1	5
41	5	1	5
44	5	1	5
46	5	1	5
48	5	1	5
50	5	1	5
54	5	1	5
56	5	1	5
58	5	1	5
60	5	1	5
72	5	1	5
73	5	1	5
74	5	1	5
75	5	1	5
76	5	1	5
77	5	1	5
79	5	1	5
80	5	1	5
81	5	1	5
96	1	4	3
97	4	2	1
98	5	1	5
99	5	1	5
100	5	1	5
101	1	1	1
6	4	1	7
7	3	1	5
8	1	1	1
29	1	4	1
102	5	1	5
103	5	1	5
104	5	1	5
105	5	1	5
106	5	1	5
107	5	1	5
108	5	1	5
109	5	1	5
110	5	1	5
111	5	1	5
112	3	4	1
113	5	1	5
\.


--
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.admin (id, point_id, salary, login, password) FROM stdin;
8	1	25000	admin1	$2y$10$/PMscuC3phf6f6k1UdKkk.F1HAkgKF./oNrOrLXuGwkwSHVwReZ1q
9	2	30000	admin2	$2y$10$o7M73Yobl0IiYdAFzRWri.kFHi5a1nXIA/Sl5JkN54ep0oULDbV4S
10	1	25000	admin3	$2y$10$.mNXwd0pnLOxg2y41oyuqeTiOfwdJtGJdhg9RoCxZpSZno0orQjzG
11	3	10000	admin4	$2y$10$PY9utD1nS6oZOwZJPevE1uMe8H9texgfaiJvG33lW4ZOzCaDM/bqS
12	3	10000	admin5	$2y$10$ULC5LeqakqzJ9kYzIUwSxO2F.lAJ16NdD/MXSHr30huI6MUPKYnzu
\.


--
-- Data for Name: status; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.status (id, name) FROM stdin;
5	banned
6	unBanned
\.


--
-- Data for Name: blacklist; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.blacklist (id, participant_id, description, status_id, date) FROM stdin;
29	5	Разбанили, он искупил свою вину	6	2022-04-17 20:00:00
30	5	Забанили по причине ужасного обращения с книгами	5	2022-04-17 19:58:30
28	5	Новое обновлиене статуса	5	2022-04-17 19:58:30
\.


--
-- Data for Name: currency; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.currency (id, code, name, description) FROM stdin;
1	643	RUB	Рубль
\.


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
\.


--
-- Data for Name: purchase_prices; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.purchase_prices (book_id, date, price, currency_id, id) FROM stdin;
1	2021-08-30 00:00:00	28940	1	16
2	2021-04-09 00:00:00	14252	1	17
3	2021-07-27 00:00:00	43000	1	18
4	2021-11-10 00:00:00	12000	1	19
5	2021-10-31 00:00:00	73200	1	20
\.


--
-- Name: act_of_taking_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.act_of_taking_id_seq', 113, true);


--
-- Name: blacklist_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.blacklist_id_seq', 30, true);


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
-- Name: publication_house_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.publication_house_id_seq', 2, true);


--
-- Name: purchase_prices_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.purchase_prices_id_seq', 20, true);


--
-- Name: status_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.status_id_seq', 20, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 12, true);


--
-- PostgreSQL database dump complete
--

