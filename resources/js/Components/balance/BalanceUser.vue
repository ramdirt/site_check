<template lang="pug">
Card.sc__card
  h3.sc__title Баланс
  h1.text-2xl {{ wallet }} рублей
  p.mt-2 Стоимость проверки 1 сайта: {{ price }} рублей
  p.mt-2 Баланса хватит на {{ getNumberOfChecksDependingOnTheWallet }} проверок
  p.mt-2 Баланса хватит на: ~{{ remainingDays }} дней
  p.mt-2 {{ numberOfChecksPerDayToInterval }} проверок будет еще за сегодня
</template>

<script setup>
import { useStore } from "@/Stores/index";
const store = useStore();

const wallet = store.props_page.auth.user.wallet;
const price = store.props_page.price;
const userInterval = store.user.interval;

const getNumberOfChecksDependingOnTheWallet = Math.ceil(wallet / price);

const now = new Date();
const remainingTime = (24 - now.getHours()) * 60 + (60 - now.getMinutes());

const numberOfChecksPerDayToInterval = Math.ceil(remainingTime / userInterval);

const remainingDays = Math.ceil(
  getNumberOfChecksDependingOnTheWallet / (1440 / userInterval)
);
</script>