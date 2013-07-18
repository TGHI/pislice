var Observer = new Class({
  Implements: [Options, Events],
  options: {
    periodical: !1,
    delay: 1E3
  },
  initialize: function (a, b, c) {
    this.element = document.id(a) || $document.id(a);
    this.addEvent("onFired", b);
    this.setOptions(c);
    this.bound = this.changed.bind(this);
    this.resume()
  },
  changed: function () {
    var a = this.element.get("value");
    $equals(this.value, a) || ($$('.button-container').addClass("loading"), this.clear(), this.value = a, this.timeout = this.onFired.delay(this.options.delay, this))
  },
  setValue: function (a) {
    this.value = a;
    this.element.set("value", a);
    return this.clear()
  },
  onFired: function () {
    this.fireEvent("onFired", [this.value, this.element]);
    $$('.button-container').removeClass("loading")
  },
  clear: function () {
    clearTimeout(this.timeout || null);
    return this
  },
  pause: function () {
    this.timer ? clearTimeout(this.timer) : this.element.removeEvent("keyup", this.bound);
    return this.clear()
  },
  resume: function () {
    this.value = this.element.get("value");
    this.options.periodical ? this.timer = this.changed.periodical(this.options.periodical, this) : this.element.addEvent("keyup", this.bound);
    return this
  }
}),
  $equals = function (a, b) {
    return a == b || JSON.encode(a) == JSON.encode(b)
  }, Autocompleter = new Class({
    Implements: [Options, Events],
    options: {
      minLength: 1,
      markQuery: !0,
      width: "inherit",
      maxChoices: 10,
      injectChoice: null,
      customChoices: null,
      emptyChoices: null,
      visibleChoices: !0,
      className: "autocompleter-choices dropdown-menu anim",
      zIndex: 9999,
      delay: 300,
      observerOptions: {},
      fxOptions: {},
      autoSubmit: !0,
      overflow: !1,
      overflowMargin: 25,
      selectFirst: !1,
      filter: null,
      filterCase: !1,
      filterSubset: !1,
      forceSelect: !1,
      selectMode: !0,
      choicesMatch: null,
      multiple: !1,
      separator: ", ",
      separatorSplit: /\s*[,;]\s*/,
      autoTrim: !1,
      allowDupes: !1,
      cache: !0,
      relative: !1
    },
    initialize: function (a, b) {
      this.element = document.id(a);
      this.setOptions(b);
      this.build();
      this.observer = new Observer(this.element, this.prefetch.bind(this), Object.merge({}, {
        delay: this.options.delay
      }, this.options.observerOptions));
      this.queryValue = null;
      this.options.filter && (this.filter = this.options.filter.bind(this));
      var c = this.options.selectMode;
      this.typeAhead = "type-ahead" == c;
      this.selectMode = !0 === c ? "selection" : c;
      this.cached = []
    },
    build: function () {
      document.id(this.options.customChoices) ? this.choices = this.options.customChoices : (this.choices = (new Element("ul", {
        "class": this.options.className,
        styles: {
          zIndex: this.options.zIndex
        }
      })).inject(document.body), this.relative = !1, this.options.relative && (this.choices.inject(this.element, "after"), this.relative = this.element.getOffsetParent()), this.fix = new OverlayFix(this.choices));
      this.options.separator.test(this.options.separatorSplit) || (this.options.separatorSplit = this.options.separator);
      this.fx = !this.options.fxOptions ? null : (new Fx.Tween(this.choices, Object.merge({}, {
        property: "opacity",
        link: "cancel",
        duration: 200
      }, this.options.fxOptions))).addEvent("onStart", Chain.prototype.clearChain).set(0);
      this.element.setProperty("autocomplete", "off").addEvent(Browser.ie || Browser.safari || Browser.chrome ? "keydown" : "keypress", this.onCommand.bind(this)).addEvent("click", this.onCommand.bind(this, [!1])).addEvent("focus", this.toggleFocus.pass({
        bind: this,
        arguments: !0,
        delay: 100
      })).addEvent("blur", this.toggleFocus.pass({
        bind: this,
        arguments: !1,
        delay: 100
      }))
    },
    destroy: function () {
      this.fix && this.fix.destroy();
      this.choices = this.selected = this.choices.destroy()
    },
    toggleFocus: function (a) {
      (this.focussed = a) || this.hideChoices(!0);
      this.fireEvent(a ? "onFocus" : "onBlur", [this.element])
    },
    onCommand: function (a) {
      if (!a && this.focussed) return this.prefetch();
      if (a && a.key && !a.shift) switch (a.key) {
        case "enter":
          if (this.element.value != this.opted) break;
          if (this.selected && this.visible) return this.choiceSelect(this.selected), !! this.options.autoSubmit;
          break;
        case "up":
        case "down":
          return !this.prefetch() && null !== this.queryValue && (a = "up" == a.key, this.choiceOver((this.selected || this.choices)[this.selected ? a ? "getPrevious" : "getNext" : a ? "getLast" : "getFirst"](this.options.choicesMatch), !0)), !1;
        case "esc":
        case "tab":
          this.hideChoices(!0)
      }
      return !0
    },
    setSelection: function (a) {
      var b = this.selected.inputValue,
        c = b,
        d = this.queryValue.length,
        e = b.length;
      b.substr(0, d).toLowerCase() != this.queryValue.toLowerCase() && (d = 0);
      if (this.options.multiple) {
        var f = this.options.separatorSplit,
          c = this.element.value,
          d = d + this.queryIndex,
          e = e + this.queryIndex,
          f = c.substr(this.queryIndex).split(f, 1)[0],
          c = c.substr(0, this.queryIndex) + b + c.substr(this.queryIndex + f.length);
        a && (c = c.split(this.options.separatorSplit).filter(function (a) {
          return this.test(a)
        }, /[^\s,]+/), this.options.allowDupes || (c = [].combine(c)), e = this.options.separator, c = c.join(e) + e, e = c.length)
      }
      this.observer.setValue(c);
      this.opted = c;
      if (a || "pick" == this.selectMode) d = e;
      this.element.selectRange(d, e);
      this.fireEvent("onSelection", [this.element, this.selected, c, b])
    },
    showChoices: function () {
      var a = this.options.choicesMatch,
        b = this.choices.getFirst(a);
      this.selected = this.selectedValue = null;
      if (this.fix) {
        var c = this.element.getCoordinates(this.relative),
          d = this.options.width || "auto";
        this.choices.setStyles({
          left: c.left,
          top: c.bottom,
          width: !0 === d || "inherit" == d ? c.width : d
        })
      }
      b && (this.visible || (this.visible = !0, this.choices.setStyle("display", "block"), this.fx && this.fx.start(1), this.fireEvent("onShow", [this.element, this.choices])), (this.options.selectFirst || this.typeAhead || b.inputValue == this.queryValue) && this.choiceOver(b, this.typeAhead), b = this.choices.getChildren(a), c = this.options.maxChoices, a = {
        overflowY: "hidden",
        height: ""
      }, this.overflown = !1, b.length > c && (b = b[c - 1], a.overflowY = "scroll", a.height = b.getCoordinates(this.choices).bottom, this.overflown = !0), this.choices.setStyles(a), this.fix.show(), this.options.visibleChoices && (a = document.getScroll(), b = document.getSize(), c = this.choices.getCoordinates(), c.right > a.x + b.x && (a.x = c.right - b.x), c.bottom > a.y + b.y && (a.y = c.bottom - b.y), window.scrollTo(Math.min(a.x, c.left), Math.min(a.y, c.top))))
    },
    hideChoices: function (a) {
      a && (a = this.element.value, this.options.forceSelect && (a = this.opted), this.options.autoTrim && (a = a.split(this.options.separatorSplit).filter($arguments(0)).join(this.options.separator)), this.observer.setValue(a));
      this.visible && (this.visible = !1, this.selected && this.selected.removeClass("autocompleter-selected"), this.observer.clear(), a = function () {
        this.choices.setStyle("display", "none");
        this.fix.hide()
      }.bind(this), this.fx ? this.fx.start(0).chain(a) : a(), this.fireEvent("onHide", [this.element, this.choices]))
    },
    prefetch: function () {
      var a = this.element.value,
        b = a;
      if (this.options.multiple) var c = this.options.separatorSplit,
      b = a.split(c), d = this.element.getSelectedRange().start, a = a.substr(0, d).split(c), c = a.length - 1, d = d - a[c].length, b = b[c];
      if (b.length < this.options.minLength) this.hideChoices();
      else if (b === this.queryValue || this.visible && b == this.selectedValue) {
        if (this.visible) return !1;
        this.showChoices()
      } else this.queryValue = b, this.queryIndex = d, this.fetchCached() || this.query();
      return !0
    },
    fetchCached: function () {
      return !1
    },
    update: function (a) {
      this.choices.empty();
      var b = (this.cached = a) && typeOf(a);
      !b || "array" == b && !a.length || "hash" == b && !a.getLength() ? (this.options.emptyChoices || this.hideChoices).call(this) : (this.options.maxChoices < a.length && !this.options.overflow && (a.length = this.options.maxChoices), a.each(this.options.injectChoice || function (a) {
        var b = new Element("li", {
          html: this.markQueryValue(a)
        });
        b.inputValue = a;
        this.addChoiceEvents(b).inject(this.choices)
      }, this), this.showChoices())
    },
    choiceOver: function (a, b) {
      if (a && a != this.selected && (this.selected && this.selected.removeClass("autocompleter-selected"), this.selected = a.addClass("autocompleter-selected"), this.fireEvent("onSelect", [this.element, this.selected, b]), this.selectMode || (this.opted = this.element.value), b)) {
        this.selectedValue = this.selected.inputValue;
        if (this.overflown) {
          var c = this.selected.getCoordinates(this.choices),
            d = this.options.overflowMargin,
            e = this.choices.scrollTop,
            f = this.choices.offsetHeight,
            g = e + f;
          c.top - d < e && e ? this.choices.scrollTop = Math.max(c.top - d, 0) : c.bottom + d > g && (this.choices.scrollTop = Math.min(c.bottom - f + d, g))
        }
        this.selectMode && this.setSelection()
      }
    },
    choiceSelect: function (a) {
      a && this.choiceOver(a);
      this.setSelection(!0);
      this.queryValue = !0;
      this.hideChoices();
	 },
    filter: function (a) {
      return (a || this.tokens).filter(function (a) {
        return this.test(a)
      }, RegExp((this.options.filterSubset ? "" : "^") + this.queryValue.escapeRegExp(), this.options.filterCase ? "" : "i"))
    },
    markQueryValue: function (a) {
      return !this.options.markQuery || !this.queryValue ? a : a.replace(RegExp("(" + (this.options.filterSubset ? "" : "^") + this.queryValue.escapeRegExp() + ")", this.options.filterCase ? "" : "i"), '<span class="autocompleter-queried">$1</span>')
    },
    addChoiceEvents: function (a) {
      return a.addEvents({
        mouseover: this.choiceOver.bind(this, a),
        click: this.choiceSelect.bind(this, a)
      })
    }
  }),
  OverlayFix = new Class({
    initialize: function (a) {
      Browser.ie && (this.element = document.id(a), this.relative = this.element.getOffsetParent(), this.fix = (new Element("iframe", {
        frameborder: "0",
        scrolling: "no",
        src: "javascript:false;",
        styles: {
          position: "absolute",
          border: "none",
          display: "none",
          filter: "progid:DXImageTransform.Microsoft.Alpha(opacity=0)"
        }
      })).inject(this.element, "after"))
    },
    show: function () {
      if (this.fix) {
        var a = this.element.getCoordinates(this.relative);
        delete a.right;
        delete a.bottom;
        this.fix.setStyles(Object.append(a, {
          display: "block",
          zIndex: (this.element.getStyle("zIndex") || 1) - 1
        }))
      }
      return this
    },
    hide: function () {
      this.fix && this.fix.setStyle("display", "none");
      return this
    },
    destroy: function () {
      this.fix && (this.fix = this.fix.destroy())

    }
  });
Element.implement({
  getSelectedRange: function () {
    if (!Browser.ie) return {
        start: this.selectionStart,
        end: this.selectionEnd
    };
    var a = {
      start: 0,
      end: 0
    }, b = this.getDocument().selection.createRange();
    if (!b || b.parentElement() != this) return a;
    var c = b.duplicate();
    if ("text" == this.type) a.start = 0 - c.moveStart("character", -1E5), a.end = a.start + b.text.length;
    else {
      var d = this.value,
        d = d.length - d.match(/[\n\r]*$/)[0].length;
      c.moveToElementText(this);
      c.setEndPoint("StartToEnd", b);
      a.end = d - c.text.length;
      c.setEndPoint("StartToStart", b);
      a.start = d - c.text.length
    }
    return a
  },
  selectRange: function (a, b) {
    if (Browser.ie) {
      var c = this.value.substr(a, b - a).replace(/\r/g, "").length;
      a = this.value.substr(0, a).replace(/\r/g, "").length;
      var d = this.createTextRange();
      d.collapse(!0);
      d.moveEnd("character", a + c);
      d.moveStart("character", a);
      d.select()
    } else this.focus(), this.setSelectionRange(a, b);
    return this
  }
});
Autocompleter.Base = Autocompleter;
Autocompleter.Request = new Class({
  Extends: Autocompleter,
  options: {
    postData: {},
    ajaxOptions: {},
    postVar: "value"
  },
  query: function () {
    var a = this.options.postData.unlink || {};
    a[this.options.postVar] = this.queryValue;
    var b = document.id(this.options.indicator);
    b && b.setStyle("display", "");
    (b = this.options.indicatorClass) && this.element.addClass(b);
    this.fireEvent("onRequest", [this.element, this.request, a, this.queryValue]);
    this.request.send({
      data: a
    })
  },
  queryResponse: function () {
    var a = document.id(this.options.indicator);
    a && a.setStyle("display", "none");
    (a = this.options.indicatorClass) && this.element.removeClass(a);
    return this.fireEvent("onComplete", [this.element, this.request])
  }
});
Autocompleter.Request.JSON = new Class({
  Extends: Autocompleter.Request,
  initialize: function (a, b, c) {
    this.parent(a, c);
    this.request = (new Request.JSON(Object.merge({}, {
      url: b,
      link: "cancel"
    }, this.options.ajaxOptions))).addEvent("onComplete", this.queryResponse.bind(this))
  },
  queryResponse: function (a) {
    this.parent();
    this.update(a)
  }
});
Autocompleter.Request.HTML = new Class({
  Extends: Autocompleter.Request,
  initialize: function (a, b, c) {
    this.parent(a, c);
    this.request = (new Request.HTML(Object.merge({}, {
      url: b,
      link: "cancel",
      update: this.choices
    }, this.options.ajaxOptions))).addEvent("onComplete", this.queryResponse.bind(this))
  },
  queryResponse: function (a, b) {
    this.parent();
    !b || !b.length ? this.hideChoices() : (this.choices.getChildren(this.options.choicesMatch).each(this.options.injectChoice || function (a) {
      var b = a.innerHTML;
      a.inputValue = b;
      this.addChoiceEvents(a.set("html", this.markQueryValue(b)))
    }, this), this.showChoices())
  }
});
Autocompleter.Ajax = {
  Base: Autocompleter.Request,
  Json: Autocompleter.Request.JSON,
  Xhtml: Autocompleter.Request.HTML
};