<script>
    $( function () {
        $(' #log-new' ).on( 'input', function () {
            $e = $( this );

            if ( $( this ).val().length == 0 ) {
                $( '#log-new-button' ).addClass( 'disabled' );
            } else {
                $( '#log-new-button' ).removeClass( 'disabled' );
            }
        } );
    } );

    function removeLog(id) {
        $('#log-'+id).remove();
    }

    function updateLog(id) {
        alert('Succesvol geüpdatet')
    }
	
	function addLog(data) {
        makeLog(data);
        $('#log-new').val('');
        $( '#log-new-button' ).addClass( 'disabled' );
    }

    /**
     * Renders a new log
     *
     * @param {object} data {id, content, date}
     */
    function makeLog(data) {
        let date = new Date(data.date);

        $("#logboek").prepend(`
                
        <div class="row" id = "log-${data.id}">
                <div class="input-field col s10">            
                    <span style="font-weight: bold;">${data.date} (${weekdays[date.getDay()]}): </span>
                    <textarea class="content materialize-textarea">${data.content}</textarea>
                    
                </div>
                <div class="input-field col s2">
                    <a class='dropdown-trigger btn btn-floating btn-large waves-effect waves-light grey' href='#' data-target='dropdown-log-${data.id}'><i class="material-icons">more_horiz</i></a>

                    <ul id='dropdown-log-${data.id}' class='dropdown-content'>
                        <li><a onclick="logUpdate(${data.id}, $('#log-${data.id} textarea').val(), updateLog)">UPDATE</a></li>
                        <li><a class="red white-text" onclick="logDelete(${data.id}, removeLog)">DELETE</a></li>
                    </ul>
                </div>
            </div>
        `);
        M.textareaAutoResize($('#log-'+data.id+' textarea'));
        $('#log-'+data.id+' a.dropdown-trigger').dropdown();
    }

    function renderLogs(data) {
        for (let i of data) {
            makeLog(i);
        }
    }
</script>