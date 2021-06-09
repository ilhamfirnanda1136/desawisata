function capitalize_Words(str) {
  return str.replace(/\w\S*/g, function (txt) {
    return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase()
  })
}
function elid(el) {
  return document.getElementById(el)
}
function elqs(el) {
  return document.querySelector(el)
}
function onCreateEl(el) {
  return document.createElement(el)
}
function onEvent(event, cb) {
  if (Array.isArray(cb)) {
    for (let i of cb) {
      document.addEventListener(event, i)
    }
  }
  document.addEventListener(event, cb)
}

function onNotif(icon, message) {
  swal({
    title: 'Pesan!',
    icon: icon,
    text: message,
  })
}

function loading() {
  $('.lds-dual-ring').show()
  $('.div-loading').addClass('background-load')
}
function matikanLoading() {
  $('.lds-dual-ring').hide()
  $('.div-loading').removeClass('background-load')
}
function hapusvalidasi(key, edit = false) {
  let pesan = edit === true ? $('#edit_' + key) : $('#' + key)
  let text = edit === true ? $('.edit_' + key) : $('.' + key)
  pesan.removeClass('is-invalid')
  text.removeClass('invalid-feedback')
  text.text(null)
}
function tambahvalidasi(key, value, edit = false) {
  let pesan = edit === true ? $('#edit_' + key) : $('#' + key)
  let text = edit === true ? $('.edit_' + key) : $('.' + key)
  pesan.addClass('is-invalid')
  text.addClass('invalid-feedback')
  text.text(value)
}
function formatAngka(angka) {
  var reverse = angka.toString().split('').reverse().join(''),
    ribuan = reverse.match(/\d{1,3}/g)
  ribuan = ribuan.join('.').split('').reverse().join('')
  return ribuan
}

function wordWrap(str, maxWidth) {
  if (str.indexOf('<') === 0) {
    return str
  }
  var newLineStr = '<br>'
  done = false
  res = ''
  while (str.length > maxWidth) {
    found = false
    // Inserts new line at first whitespace of the line
    for (i = maxWidth - 1; i >= 0; i--) {
      if (testWhite(str.charAt(i))) {
        res = res + [str.slice(0, i), newLineStr].join('')
        str = str.slice(i + 1)
        found = true
        break
      }
    }
    // Inserts new line at maxWidth position, the word is too long to wrap
    if (!found) {
      res += [str.slice(0, maxWidth), newLineStr].join('')
      str = str.slice(maxWidth)
    }
  }
  return res + str
}

function testWhite(x) {
  var white = new RegExp(/^\s$/)
  return white.test(x.charAt(0))
}
