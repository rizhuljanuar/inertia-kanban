<script setup>
import { PencilIcon } from "@heroicons/vue/solid";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import { computed, nextTick } from "vue";
import { store } from "@/store";

const props = defineProps({
  card: Object,
});

const isShowingForm = computed(
  () => props.card.id === store.value.editingCardId
);
const inputTitleRef = ref();
const form = useForm({
  title: props.card.title,
});

async function showForm() {
  store.value.editingCardId = props.card.id;
  isShowingForm.value = true;
  await nextTick();
  inputTitleRef.value.focus();
}

function onSubmit() {
  form.put(route("cards.update", { card: props.card.id }), {
    onSuccess: () => (store.value.editingCardId = null),
  });
}
</script>

<template>
  <li
    class="
      group
      relative
      bg-white
      p-2
      shadow
      rounded-md
      border-b border-gray-300
      hover:bg-gray-50
    "
  >
    <form
      @keydown.esc="store.editingCardId = null"
      v-if="isShowingForm"
      @submit.prevent="onSubmit()"
    >
      <textarea
        v-model="form.title"
        ref="inputTitleRef"
        rows="3"
        @keydown.enter.prevent="onSubmit()"
        type="text"
        class="
          block
          w-full
          text-sm
          rounded-md
          border-gray-300
          shadow-sm
          focus:border-blue-400 focus:ring-blue-400
        "
        placeholder="Enter card title..."
      ></textarea>

      <div class="mt-2 space-x-2">
        <button
          type="submit"
          class="
            px-4
            py-2
            text-sm
            font-medium
            text-white
            bg-rose-600
            hover:bg-rose-500
            rounded-md
            shadow-sm
            focus:ring-2
            focus:ring-offset-2
            focus:ring-rose-500
            focus:outline-none
          "
        >
          Save card
        </button>
        <button
          type="button"
          @click="store.editingCardId = null"
          class="
            px-4
            py-2
            text-sm
            font-medium
            text-gray-700
            hover:text-black
            rounded-md
            focus:ring-2
            focus:ring-offset-2
            focus:ring-rose-500
            focus:outline-none
          "
        >
          Cancel
        </button>
      </div>
    </form>
    <template v-if="!isShowingForm">
      <a href="#" class="text-sm">{{ card.title }}</a>
      <button
        @click="showForm()"
        class="
          hidden
          absolute
          top-1
          right-1
          w-8
          h-8
          bg-gray-50
          group-hover:grid
          place-content-center
          rounded-md
          text-gray-600
          hover:text-black hover:bg-gray-200
        "
      >
        <PencilIcon class="w-5 h-5" />
      </button>
    </template>
  </li>
</template>