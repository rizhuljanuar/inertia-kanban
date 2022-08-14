<script setup>
import { PlusIcon } from "@heroicons/vue/solid";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import { nextTick } from "@vue/runtime-core";

const props = defineProps({
  list: Object,
});

const emit = defineEmits(["created"]);
const isShowingForm = ref(false);
const inputNameRef = ref();
const form = useForm({
  title: "",
  card_list_id: props.list.id,
  board_id: props.list.board_id,
});

async function showForm() {
  isShowingForm.value = true;
  await nextTick();
  inputNameRef.value.focus();
}

function onSubmit() {
  form.post(route("cards.store"), {
    onSuccess: () => {
      form.reset();
      inputNameRef.value.focus();
      emit("created");
    },
  });
}
</script>

<template>
  <form
    @keydown.esc="isShowingForm = false"
    v-if="isShowingForm"
    @submit.prevent="onSubmit()"
  >
    <textarea
      v-model="form.title"
      ref="inputNameRef"
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
        Add card
      </button>
      <button
        type="button"
        @click="isShowingForm = false"
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

  <button
    @click="showForm()"
    v-if="!isShowingForm"
    class="
      flex
      items-center
      p-2
      text-sm
      font-medium
      text-gray-600
      hover:text-black hover:bg-gray-300
      w-full
      rounded-md
    "
  >
    <PlusIcon class="h-5 w-5" />
    <span class="ml-1">Add card</span>
  </button>
</template>