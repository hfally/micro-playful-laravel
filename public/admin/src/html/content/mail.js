// Focus to 'To input' when modal shown
      $('#composeModal').on('shown.bs.modal', () => {
        document.querySelector('#mailTo').focus()
      })

      // Text editor
      $('#summernote-editor').summernote({
        dialogsInBody: true,
        height: 150,
        placeholder: 'Write your message here',
        toolbar: [
          ['font', ['bold', 'underline', 'italic']],
          ['insert', ['link', 'picture']],
        ],
      })

      // Toggle Starred / Unstarred
      for (const el of document.querySelectorAll('.btn-starred')) {
        const tr      = el.closest('tr')
        const starred = tr.classList.contains('starred')
        el.title      = starred ? 'Starred' : 'Not starred' // fill title
        starred ? el.classList.add('active') : el.classList.remove('active') // toggle 'active' class
        el.addEventListener('click', function () {
          tr.classList.toggle('starred') // toggle 'starred' class
          el.title = this.classList.contains('active') ? 'Not starred' : 'Starred' // update title
        })
      }

      // Select options
      for (const el of document.querySelectorAll('[data-toggle="mail-checkbox"]')) {
        el.addEventListener('click', function () {
          const allcb = 'tr > td:first-child input[type="checkbox"], tr > th:first-child input[type="checkbox"]'
          for (const el of this.closest('table').querySelectorAll(allcb)) {
            el.checked && el.click() // uncheck all
          }
          let selector
          switch (this.dataset.check) {
            case 'all': selector = allcb; break;
            case 'read': selector = 'tbody tr:not(.unread) > td:first-child input[type="checkbox"]'; break;
            case 'unread': selector = 'tbody tr.unread > td:first-child input[type="checkbox"]'; break;
            case 'starred': selector = 'tbody tr.starred > td:first-child input[type="checkbox"]'; break;
            case 'unstarred': selector = 'tbody tr:not(.starred) > td:first-child input[type="checkbox"]'; break;
          }
          for (const cb of this.closest('table').querySelectorAll(selector)) {
            !cb.checked && cb.click()
          }
        })
      }

      // Show mail content
      const tabPane = document.querySelector('#tab-content-mail').querySelectorAll('.tab-pane')
      for (const el of document.querySelectorAll('.list-mail-item-subject')) {
        el.addEventListener('click', function (e) {
          for (const tp of tabPane) {
            tp.setAttribute('hidden', true) // hide all tab pane
          }
          document.querySelector('#mail-content').removeAttribute('hidden') // unhide mail-content
          e.preventDefault()
        })
      }

      // Back to inbox list
      for (const el of document.querySelectorAll('.to-inbox')) {
        el.addEventListener('click', function (e) {
          for (const tp of tabPane) {
            tp.removeAttribute('hidden') // unhide all tab pane
          }
          document.querySelector('#mail-content').setAttribute('hidden', true) // hide mail-content
          e.preventDefault()
        })
      }