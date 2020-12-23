<?php


 
namespace app\Repositories;

class Emotion
{

    //表情替换 \[[\w-\d]+\]
    function replace_emotion($content)
    {

        preg_match_all('/\[[\s\S]+?\]/', $content, $arr);
        $emotions = array(
            "[ej-01]" => 'tieba_emotion_01',
            "[ej-02]" => 'tieba_emotion_02',
            "[ej-03]" => 'tieba_emotion_03',
            "[ej-04]" => 'tieba_emotion_04',
            "[ej-05]" => 'tieba_emotion_05',
            "[ej-06]" => 'tieba_emotion_06',
            "[ej-07]" => 'tieba_emotion_07',
            "[ej-08]" => 'tieba_emotion_08',
            "[ej-09]" => 'tieba_emotion_09',
            "[ej-10]" => 'tieba_emotion_10',
            "[ej-11]" => 'tieba_emotion_11',
            "[ej-12]" => 'tieba_emotion_12',
            "[ej-13]" => 'tieba_emotion_13',
            "[ej-14]" => 'tieba_emotion_14',
            "[ej-15]" => 'tieba_emotion_15',
            "[ej-16]" => 'tieba_emotion_16',

            "[dog-00]" => 'tieba_dog00',
            "[dog-01]" => 'tieba_dog01',
            "[dog-02]" => 'tieba_dog02',
            "[dog-03]" => 'tieba_dog03',
            "[dog-04]" => 'tieba_dog04',
            "[dog-05]" => 'tieba_dog05',
            "[dog-06]" => 'tieba_dog06',
            "[dog-07]" => 'tieba_dog07',
            "[dog-08]" => 'tieba_dog08',
            "[dog-09]" => 'tieba_dog09',
            "[dog-10]" => 'tieba_dog10',
            "[dog-11]" => 'tieba_dog11',
            "[dog-12]" => 'tieba_dog12',
            "[dog-13]" => 'tieba_dog13',
            "[dog-14]" => 'tieba_dog14',
            "[dog-15]" => 'tieba_dog15',

            "[爱你]"=>'tieba_emojy_aini',
            "[奥特曼]"=>'tieba_emojy_aoteman',
            "[拜拜]"=>'tieba_emojy_baibai',
            "[鄙视]"=>'tieba_emojy_bishi',
            "[馋嘴]"=>'tieba_emojy_chanzui',
            "[吃惊]"=>'tieba_emojy_chijing',
            "[打哈欠]"=>'tieba_emojy_dahaqi',
            "[打脸]"=>'tieba_emojy_dalian',
            "[锤子]"=>'tieba_emojy_ding',
            "[爱你]"=>'tieba_emojy_aini',
            "[多啦-1]"=>'tieba_emojy_dlamx',
            "[多啦-2]"=>'tieba_emojy_dlamcj',
            "[多啦-3]"=>'tieba_emojy_dlams',
            "[狗]"=>'tieba_emojy_doge',
            "[二哈]"=>'tieba_emojy_erha',
            "[肥皂]"=>'tieba_emojy_feizao',
            "[感冒]"=>'tieba_emojy_ganmao',
            "[给力]"=>'tieba_emojy_geili',
            "[肥皂]"=>'tieba_emojy_feizao',
            "[鼓掌]"=>'tieba_emojy_guzhang',
            "[哈哈]"=>'tieba_emojy_haha',
            "[害羞]"=>'tieba_emojy_haixiu',
            "[呵呵]"=>'tieba_emojy_hehe',
            "[黑线]"=>'tieba_emojy_heixian',
            "[哼]"=>'tieba_emojy_heng',
            "[花心]"=>'tieba_emojy_huaxin',
            "[互粉]"=>'tieba_emojy_hufen',
            "[囧]"=>'tieba_emojy_jiong',
            "[急眼]"=>'tieba_emojy_jiyan',
            "[可爱]"=>'tieba_emojy_keai',
            "[可怜]"=>'tieba_emojy_kelian',
            "[酷]"=>'tieba_emojy_ku',
            "[困]"=>'tieba_emojy_kun',
            "[懒得理你]"=>'tieba_emojy_landelini',
            "[累]"=>'tieba_emojy_lei',
            "[萌]"=>'tieba_emojy_meng',
            "[喵]"=>'tieba_emojy_miao',
            "[男孩儿]"=>'tieba_emojy_nanhaier',
            "[怒]"=>'tieba_emojy_nu',
            "[怒骂]"=>'tieba_emojy_numa',
            "[女孩儿]"=>'tieba_emojy_nvhaier',
            "[钱]"=>'tieba_emojy_qian',
            "[亲亲]"=>'tieba_emojy_qinqin',
            "[傻眼]"=>'tieba_emojy_shayan',
            "[生病]"=>'tieba_emojy_shengbing',
            "[神马]"=>'tieba_emojy_shenma',
            "[神兽]"=>'tieba_emojy_shenshou',
            "[失望]"=>'tieba_emojy_shiwang',
            "[帅]"=>'tieba_emojy_shuai',
            "[睡觉]"=>'tieba_emojy_shuijiao',
            "[思考]"=>'tieba_emojy_sikao',
            "[太开心]"=>'tieba_emojy_taikaixin',
            "[摊手]"=>'tieba_emojy_tanshou',
            "[偷笑]"=>'tieba_emojy_touxiao',
            "[吐]"=>'tieba_emojy_tu',
            "[兔子]"=>'tieba_emojy_tuzi',
            "[威武]"=>'tieba_emojy_v5',
            "[挖鼻屎]"=>'tieba_emojy_wabishi',
            "[委屈]"=>'tieba_emojy_weiqu',
            "[熊猫]"=>'tieba_emojy_xiongmao',
            "[笑哭]"=>'tieba_emojy_xiaoku',
            "[双喜]"=>'tieba_emojy_xi',
            "[嘻嘻]"=>'tieba_emojy_xixi',
            "[嘘]"=>'tieba_emojy_xu',
            "[阴险]"=>'tieba_emojy_yinxian',
            "[疑问]"=>'tieba_emojy_yiwen',
            "[右哼哼]"=>'tieba_emojy_youhengheng',
            "[晕]"=>'tieba_emojy_yun',
            "[织]"=>'tieba_emojy_zhi',
            "[抓狂]"=>'tieba_emojy_zhuakuang',
            "[猪头]"=>'tieba_emojy_zhutou',
            "[最右]"=>'tieba_emojy_zuiyou',
            "[左哼哼]"=>'tieba_emojy_zuohengheng',
        );
        foreach ($arr[0] as $v) {
            foreach ($emotions as $key => $value) {
                if($v==$key){
                    $content = str_replace($v, '<img src="/img/mipmap/' . $value . '.png" width="24" height="24"/>', $content);
                    continue;
                }
            }
        }
        return $content;
    }
}


?> 