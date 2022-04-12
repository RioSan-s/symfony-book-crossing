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
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.users VALUES (1, 'Павел', 'Техник', 'paveltech@mail.ru', 'customer');
INSERT INTO public.users VALUES (2, 'Наташа', 'Иванова', 'natashaivanova12@gmail.ru', 'customer');
INSERT INTO public.users VALUES (4, 'Персона', 'Неизвестная', 'panteleimon@yandex.ru', 'seller');
INSERT INTO public.users VALUES (5, 'Фабрика', 'Паттерн', 'strangerthings@gmail.com', 'seller');


--
-- Data for Name: customers; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.customers VALUES (1, 'улица нигде');
INSERT INTO public.customers VALUES (2, 'улица Алексеевская д. 5');


--
-- Data for Name: seller; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.seller VALUES (4, 30000);
INSERT INTO public.seller VALUES (5, 25000);


--
-- Data for Name: point_of_issue; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.point_of_issue VALUES (1, 'г. Нижний Новгород,ул Буревестник, д.1', 4);
INSERT INTO public.point_of_issue VALUES (2, 'г. Казань, ул. Новостройкина, д. 10', 5);


--
-- Data for Name: act_of_order; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.act_of_order VALUES (1, 1, 2);
INSERT INTO public.act_of_order VALUES (2, 2, 1);


--
-- Data for Name: currency; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.currency VALUES (1, 'Рубль', 'RUB');


--
-- Data for Name: product; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.product VALUES (5, 'Мышка Razer');
INSERT INTO public.product VALUES (6, 'Пылесос Sos3');
INSERT INTO public.product VALUES (7, 'Электронная сигарета 4en');


--
-- Data for Name: position_order; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.position_order VALUES (1, 5, 1);
INSERT INTO public.position_order VALUES (2, 6, 2);
INSERT INTO public.position_order VALUES (3, 7, 1);


--
-- Data for Name: prices; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.prices VALUES (1, 5, 3000, 1);
INSERT INTO public.prices VALUES (2, 5, 6000, 1);
INSERT INTO public.prices VALUES (3, 6, 23000, 1);
INSERT INTO public.prices VALUES (4, 7, 2500, 1);


--
-- Data for Name: providers; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.providers VALUES (1, 'АкваТроник', 'Калининград');
INSERT INTO public.providers VALUES (2, 'Хьюберт ', 'Нижний Новгород');
INSERT INTO public.providers VALUES (3, 'Мираж', 'Орел');


--
-- Data for Name: providers_to_orders; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.providers_to_orders VALUES (1, 5);
INSERT INTO public.providers_to_orders VALUES (2, 6);
INSERT INTO public.providers_to_orders VALUES (3, 7);
INSERT INTO public.providers_to_orders VALUES (1, 6);


--
-- Name: act_of_order_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.act_of_order_id_seq', 2, true);


--
-- Name: currency_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.currency_id_seq', 1, true);


--
-- Name: point_of_issue_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.point_of_issue_id_seq', 2, true);


--
-- Name: position_order_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.position_order_id_seq', 3, true);


--
-- Name: prices_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.prices_id_seq', 4, true);


--
-- Name: product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.product_id_seq', 7, true);


--
-- Name: providers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.providers_id_seq', 3, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 5, true);


--
-- PostgreSQL database dump complete
--

