<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/orgchart-master/dist/css/jquery.orgchart.css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/orgchart-master/examples/css/style.css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/orgchart-master/dist/js/jquery.orgchart.js"></script>
<a class="btn btn-warning btn-reset-zoom-pan">Reset Zoom/Pan</a>
<div id="chart-container"></div>
<script type="text/javascript" src="https://cdn.rawgit.com/jakerella/jquery-mockjax/master/dist/jquery.mockjax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
<script type="text/javascript"  >
    var ajaxURLs = {
      'children': "<?php echo base_url(); ?>/petajabatan/struktur/load_tree/children/",
      'parent': "<?php echo base_url(); ?>/petajabatan/struktur/load_tree/parent/",
      'siblings': function(nodeData) {
        return "<?php echo base_url(); ?>/petajabatan/struktur/load_tree/siblings/" + nodeData.id;
      },
      'families': function(nodeData) {
        return "<?php echo base_url(); ?>/petajabatan/struktur/load_tree/families/" + nodeData.id;
      }
    };
    $(".btn-reset-zoom-pan").click(function(){
        $('.orgchart').css('transform',''); // remove the tansform settings
    });
    $('#chart-container').orgchart({
        'pan' : true,
        'exportButton' : true,
        'zoom':true,
        'data': "<?php echo base_url(); ?>/petajabatan/struktur/load_tree",
        'ajaxURL' : ajaxURLs,
        'depth': 2,
        'nodeContent': 'title',
        'nodeId': 'id',
        'exportFilename': 'Data Struktur',
        'exportFileextension': 'pdf'
    });
</script>
<style>
    #chart-container .content {
        min-height:0;
    }
    #chart-container .orgchart {
        /*height: 100%;
        width: 100%;*/
    }
    #chart-container .orgchart .node {
        width:250px;
    }
    #chart-container .orgchart {
        background-image :none;
    }
    #chart-container .orgchart .node .content {
        height:auto;
        overflow:auto;
        white-space:normal;
    }
</style>
