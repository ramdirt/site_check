<template lang='pug'>
Card.sc__card
  h3.sc__title Ваши сайты
  Table(
    border,
    :columns="table.columns",
    :data="store.sites",
    @on-row-click="handleContextMenu"
  )

  p.mt-2 Нажмите на строчку в таблице чтобы получить подробную информацию
  SitesModal(:data-modal="dataModal")
</template>

<script setup>
import SitesModal from "@/Components/sites/SitesModal";
import sitesTableMixin from "@/Mixins/sites/sitesTableMixin";
import { ref } from "vue";
import { useStore } from "@/Stores/index";

const store = useStore();

store.getSites();

const { table } = sitesTableMixin();

const dataModal = ref({
  open: null,
  id: null,
  title: null,
  status: null,
  url: null,
  last_check: null,
});

const handleContextMenu = (row) => {
  dataModal.value.open = true;
  dataModal.value.title = `Сайт: ${row.name}`;
  dataModal.value.url = row.url;
  dataModal.value.id = row.id;
  dataModal.value.status = row.status === 1 ? "Доступен" : "Не доступен";
  dataModal.value.last_check = `Последняя проверка: ${store.user.last_check}`;
};
</script>