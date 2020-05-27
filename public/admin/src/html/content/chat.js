App.innerToggleSidebar()

    // Custom scrollbar
    let scrollbar = new PerfectScrollbar('.inner-sidebar-body', { wheelPropagation: false })
    $('.collapsible').on('shown.bs.collapse', function () {
      scrollbar.update()
    })

    let conversationBody = document.querySelector('.inner-main-body')
    conversationBody.scrollTop = conversationBody.scrollHeight - conversationBody.clientHeight // scroll to bottom

    // Chat attachment
    document.querySelector('.chat-form input[type="file"]').addEventListener('change', function () {
      const fileLength = this.files.length
      const filename = fileLength ? (fileLength > 1 ? `${fileLength} files` : '1 file') : '<i class="material-icons">attachment</i>'
      this.parentElement.querySelector('span').innerHTML = filename
      chatText.focus()
    })

    // autosize textarea
    autosize(document.querySelectorAll('textarea.autosize'))