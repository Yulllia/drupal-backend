(function($, Drupal) {
  Drupal.behaviors.customTooltips = {
    attach: function(context, settings) {
      const mainWidth = $("body").width();
      const contentWidth = $(".body-content").width();
      const space = (mainWidth - contentWidth) / 2;

      $(context)
        .find(".glossary-term")
        .each(function(index, element) {
          const $term = $(element);

          if ($term.find(".tooltiptext").length === 0) {
            const description = $term.attr("data-description");
            const link = $term.attr("data-link");
            const tooltipContent = description.length > 100 
              ? `${description}<br /> <a href="${link}">Read more</a>` 
              : description;

            const tooltipTextElement = $(
              `<div class="tooltiptext" id="tooltip_${index}"></div>`
            ).html(tooltipContent);

            $term.addClass("tooltip").append(tooltipTextElement);
          }

          $term.on("mouseenter", function() {
            const $tooltip = $(this).find(".tooltiptext");
            const $termWidth = $(this).width();
            const tooltipWidth = $tooltip.outerWidth();
            const tooltipHeight = $tooltip.outerHeight();
            const elementRect = $term[0].getBoundingClientRect();
            const tooltipHalfWidth = tooltipWidth / 2;
            const positionLeft = tooltipHalfWidth - (elementRect.x - space);
            const rightPosition = space + contentWidth - elementRect.x - tooltipHalfWidth;

            if (elementRect.top - tooltipHeight - 13 < 0) {
              $tooltip.addClass("bottom");
            } else {
              $tooltip.removeClass("bottom");
            }

            if (elementRect.x - space < tooltipHalfWidth) {
              $tooltip.css({ left: positionLeft }).addClass("left");
              addDynamicCss(
                `.tooltip .tooltiptext.left::after { margin-left: ${-(tooltipHalfWidth - (elementRect.x - space) - $termWidth / 2 + 12)}px; }`
              );
            } else if (rightPosition < 0) {
              $tooltip.css({ left: rightPosition }).addClass("right");
              addDynamicCss(
                `.tooltip .tooltiptext.right::after { margin-left: ${-(rightPosition - $termWidth / 2 + 12)}px; }`
              );
            } else {
              $tooltip.css({ left: "50%" });
              removeDynamicCss();
            }
          });

          $term.on("mouseleave", function() {
            $(this).find(".tooltiptext").removeClass("show");
          });
        });
    }
  };

  function addDynamicCss(rule) {
    let styleElement = document.createElement("style");
    styleElement.textContent = rule;
    document.body.appendChild(styleElement);
  }

  function removeDynamicCss() {
    let styleElement = document.querySelector(".tooltip .tooltiptext::after");
    if (styleElement) {
      styleElement.parentNode.removeChild(styleElement);
    }
  }
})(jQuery, Drupal);