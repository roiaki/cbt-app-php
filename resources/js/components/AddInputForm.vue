<template>

  <!-- 入力ボックスを表示する場所 -->
  <div v-for="(text,index) in texts">
    <!-- 各入力ボックス -->
    <div class="row mt-3">
      <div class="form-group col">
        <input 
          ref="texts"
          name="emotion_name[]"
          id="'emotion_name' + index"
          class="form-control"
          v-model="texts[index]"
          @change="checkForm(index)"
          type="text"
         
        >
        <!-- <p class="text-danger" v-if="errors[index].length">
          <b>Please correct the following error(s):</b>
          <ul>
            <li v-for="error in errors[index]">{{ error }}</li>
          </ul>
        </p> -->

        <!-- <p v-if="errors1.length">エラーあり</p>
        <p>texts[index]:{{ texts[index] }}</p>
        <p>index:{{ index }}</p>
        <p>text:{{ text }}</p>
        <p>texts{{ texts }}</p> -->
        
      </div>
      
      <div class="form-group col">
        <input 
          ref="strength"
          name="emotion_strength[]"
          id="emotion_strength"
          class="form-control"
          onchange="checkEmotionStrength(locale)"
          type="number"
        >
      </div>
    </div>   
  </div>
  
  <!-- 入力ボックスを追加するボタン -->
  <div class="btn-toolbar">
    <div class="btn-group">
      <button class="btn btn-info" type="button" @click="addInput" v-if="!isTextMax">
        ＋<span v-text="remainingTextCount"></span>
      </button>
    </div>

    <div class="btn-group ml-auto">
      <button 
        type="button" 
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
      maxTextCount: 3,
      name: "",
      errors: [],
    }
  },
  methods: {
    // ボタンをクリックしたときのイベント ①〜③
    addInput() {

      if(this.isTextMax) {
          return;
      }

      this.texts.push(''); // 配列に１つ空データを追加する

    },
    removeInput(index) {
      this.texts.splice(index, 1);
      this.strength.splice(index, 1);
    },

    checkForm(index) {
      if(this.texts[0]) {
        console.log("aru");
      }
      this.errors = [];

      if(!this.texts[0]) {
        this.errors[index].push("感情1を入力してください");
      }

      
    },

    isInValidName() {
            //文字列が4文字以上かチェックする
      return this.texts[0].length < 4;
    }
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