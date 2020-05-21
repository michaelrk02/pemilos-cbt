<div id="question-body">
    <div v-if="questionsModalShown" class="w3-modal" style="display:block">
        <div class="w3-modal-content w3-animate-top w3-card-4">
            <span class="w3-button w3-display-topright" v-on:click="hideQuestionsModal">&times;</span>
            <div class="w3-padding">
                <h3>Daftar Soal</h3>
            </div>
            <div class="w3-padding-large" style="overflow: auto">
                <?php for ($i = 0; $i < $question_count; $i++) { ?>
                    <div class="w3-padding-small" style="float: left">
                        <a class="w3-btn <?php echo ($question->id == $i) ? 'w3-yellow' : ($all_answers[$i] != -1 ? 'w3-green' : 'w3-blue-gray'); ?>" style="width: 48px" href="<?php echo site_url('exam/question/'.$i); ?>"><?php echo $i + 1; ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="w3-padding-large">
        <h3>Soal no. <?php echo $question->id + 1; ?></h3>
        <span>(<a href="#" v-on:click="showQuestionsModal">Lihat daftar soal</a>)</span>
        <div class="w3-padding">
            <span><?php echo str_replace("\n", '<br>', $question->question); ?></span>
        </div>
        <div class="w3-padding">
            <?php for ($i = 0; $i < count($choices); $i++) { ?>
                <div class="w3-padding-small">
                    <a class="w3-button w3-tiny w3-circle w3-border w3-border-black <?php if ($all_answers[$question->id] == $i) { echo 'w3-black'; } ?>" href="<?php echo site_url('exam/question/'.$question->id.'/'.$i.'#done'); ?>"><?php echo $choices[$i]; ?></a>
                    <span style="padding-left: 16px"><?php $answer_prop = 'answer_'.$i; echo $question->$answer_prop; ?></span>
                </div>
            <?php } ?>
        </div>
    </div>
    <div style="padding: 64px 0"></div>
    <div id="done">
        <div class="w3-padding-large">
            <?php if ($question->id > 0) { ?>
                <a class="w3-btn w3-green" href="<?php echo site_url('exam/question/'.($question->id - 1)); ?>">&laquo; Kembali</a>
            <?php } ?>
            <?php if ($question->id < $question_count - 1) { ?>
                <a class="w3-btn w3-green" href="<?php echo site_url('exam/question/'.($question->id + 1)); ?>">Berikutnya &raquo;</a>
            <?php } ?>
            <span style="padding-left: 24px">
                <a class="w3-btn w3-blue-gray" href="<?php echo site_url('exam/finish'); ?>" onclick="return confirm('Apakah anda yakin? Anda telah mengerjakan <?php echo $answered_count; ?> dari <?php echo $question_count; ?> soal');">Selesai</a>
            </span>
        </div>
    </div>
</div>

<script>

var questionBody = new Vue({
    el: '#question-body',
    data: {
        questionsModalShown: false
    },
    methods: {
        showQuestionsModal: function() {
            this.questionsModalShown = true;
        },
        hideQuestionsModal: function() {
            this.questionsModalShown = false;
        }
    }
});

</script>
