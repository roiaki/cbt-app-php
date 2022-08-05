<template>

  <!-- 入力ボックスを表示する場所 -->
  <div v-for="(text,index) in texts">
    <!-- 各入力ボックス -->
    <div class="row mt-3">
      <div class="form-group col">
        <input ref="texts"
                name="emotion_name[]"
                id="emotion_name[]"
                class="form-control"
                type="text"
                v-model="texts[index]"
                @keypress.shift.enter="addInput">
      </div>
      <div class="form-group col">
        <input ref="strength"
                name="emotion_strength[]"
                id="emotion_strength[]"
                class="form-control"
                type="number"
                v-model="strength[index]"
                @keypress.shift.enter="addInput">
      </div>
    </div>   
  </div>

  <!-- 入力ボックスを追加するボタン -->
  <div class="btn-toolbar">
    <div class="btn-group">
      <button class="btn btn-info" type="button" @click="addInput" v-if="!isTextMax">
          ＋
          <span v-text="remainingTextCount"></span>
      </button>
    </div>

    <div class="btn-group ml-auto">
      <button type="button" 
              class="btn btn-outline-danger mr-auto" 
              v-if="remainingTextCount < 3"
              @click="removeInput(index)">×</button>
    </div>
  </div>
  
</template>

<script>

export default {
    data:function() {
      return {
        texts: [],    
        strength: [],
        maxTextCount: 3
      }
    },
    methods: {
        // ボタンをクリックしたときのイベント ①〜③
        addInput() {

            if(this.isTextMax) {
                return;
            }

            this.texts.push(''); // 配列に１つ空データを追加する

            Vue.nextTick(() => {
                const maxIndex = this.texts.length - 1;
                console.log(maxIndex)
                this.$refs['texts'][maxIndex].focus(); // 追加された入力ボックスにフォーカスする
            });
        },
        removeInput(index) {
            this.texts.splice(index, 1);
            this.strength.splice(index, 1);
        },
    },
    computed: {
        isTextMax() {
            return (this.texts.length >= this.maxTextCount);
        },
        remainingTextCount() {
            return this.maxTextCount - this.texts.length; // 追加できる残り件数
        }
    }
}

</script>