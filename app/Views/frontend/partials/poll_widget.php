<?php 
    $activePoll = $activePoll ?? get_active_poll();
    if ($activePoll): 
?>
<div class="premium-poll-card mb-4" id="poll-container-<?= $activePoll['id'] ?>" style="background: #fff; border-radius: 20px; overflow: hidden; border: 1px solid #f1f5f9; box-shadow: 0 10px 25px rgba(0,0,0,0.03);">
    <div style="background: #0f172a; padding: 20px; position: relative; overflow: hidden;">
        <div style="position: absolute; top: -20px; right: -20px; width: 60px; height: 60px; background: rgba(220, 38, 38, 0.1); border-radius: 50%; blur: 20px;"></div>
        <h3 style="color: #fff; font-size: 16px; font-weight: 900; margin: 0; text-transform: uppercase; letter-spacing: 1px;">
            <i class="fas fa-poll-h me-2 text-red-500"></i> Public <span style="color: #dc2626;">Poll</span>
        </h3>
    </div>
    
    <div class="poll-content p-4">
        <h4 style="font-size: 18px; font-weight: 800; color: #1e293b; line-height: 1.4; margin-bottom: 20px;">
            <?= (service('language')->getLocale() == 'hi') ? $activePoll['question_hi'] : $activePoll['question_en'] ?>
        </h4>

        <div id="poll-options-wrap">
            <?php if (!$activePoll['hasVoted']): ?>
                <?php foreach($activePoll['options'] as $opt): ?>
                <div class="poll-option-item mb-3" onclick="submitPollVote(<?= $activePoll['id'] ?>, <?= $opt['id'] ?>)" style="padding: 14px 18px; border: 2px solid #f1f5f9; border-radius: 12px; cursor: pointer; transition: all 0.3s; position: relative; overflow: hidden;">
                    <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 2;">
                        <span style="font-size: 14px; font-weight: 700; color: #475569;"><?= (service('language')->getLocale() == 'hi') ? $opt['option_hi'] : $opt['option_en'] ?></span>
                        <i class="far fa-circle text-slate-300"></i>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php 
                    $totalVotes = array_sum(array_column($activePoll['options'], 'votes'));
                    foreach($activePoll['options'] as $opt): 
                        $percent = ($totalVotes > 0) ? round(($opt['votes'] / $totalVotes) * 100, 1) : 0;
                ?>
                <div class="result-item mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span style="font-size: 13px; font-weight: 800; color: #1e293b;"><?= (service('language')->getLocale() == 'hi') ? $opt['option_hi'] : $opt['option_en'] ?></span>
                        <span style="font-size: 13px; font-weight: 900; color: #dc2626;"><?= $percent ?>%</span>
                    </div>
                    <div class="progress" style="height: 10px; border-radius: 10px; background: #f1f5f9; overflow: hidden;">
                        <div class="progress-bar" style="width: <?= $percent ?>%; background: #dc2626; border-radius: 10px;"></div>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="text-center mt-3">
                    <span style="font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase;"><i class="fas fa-check-circle text-success me-1"></i> You have already voted</span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    .poll-option-item:hover { background: #fff1f2; border-color: #fecaca; transform: translateX(5px); }
    .poll-option-item:hover i { color: #dc2626; }
    .progress-bar { transition: width 1s cubic-bezier(0.165, 0.84, 0.44, 1); }
</style>

<script>
function submitPollVote(pollId, optionId) {
    const wrap = document.getElementById('poll-options-wrap');
    
    // Simple visual feedback
    wrap.style.opacity = '0.5';
    wrap.style.pointerEvents = 'none';

    $.ajax({
        url: '<?= base_url('ajax/submit-vote') ?>',
        method: 'POST',
        data: {
            poll_id: pollId,
            option_id: optionId,
            <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        },
        success: function(resp) {
            if (resp.status === 'success') {
                let html = '';
                resp.results.forEach(opt => {
                    const label = (document.documentElement.lang === 'hi') ? opt.option_hi : opt.option_en;
                    html += `
                    <div class="result-item mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span style="font-size: 13px; font-weight: 800; color: #1e293b;">${label}</span>
                            <span style="font-size: 13px; font-weight: 900; color: #dc2626;">${opt.percent}%</span>
                        </div>
                        <div class="progress" style="height: 10px; border-radius: 10px; background: #f1f5f9; overflow: hidden;">
                            <div class="progress-bar" style="width: ${opt.percent}%; background: #dc2626; border-radius: 10px;"></div>
                        </div>
                    </div>`;
                });
                html += `<div class="text-center mt-3"><span style="font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase;"><i class="fas fa-check-circle text-success me-1"></i> ${resp.msg}</span></div>`;
                
                wrap.innerHTML = html;
                wrap.style.opacity = '1';
            } else {
                alert(resp.msg);
                wrap.style.opacity = '1';
                wrap.style.pointerEvents = 'auto';
            }
        },
        error: function() {
            alert('Something went wrong. Please try again.');
            wrap.style.opacity = '1';
            wrap.style.pointerEvents = 'auto';
        }
    });
}
</script>
<?php endif; ?>
