const { Dashicon, Button, TextControl } = wp.components;
const { useState, useEffect } = wp.element;
const { escapeHTML } = wp.escapeHtml;
const { __ } = wp.i18n;
const { customize } = wp;
import { TypographyComponent } from "./typographyComponent";
import { BlogmaticControlHeader } from "./component-function";
import { store as myCustomStore } from './store';
const { useDispatch } = wp.data

export const BlogmaticTypographyPreset = ( props ) => {
    const [ typoPresets, setTypoPresets ] = useState( props.value.typographies )
    const [ presetLabels, setPresetLabels ] = useState( props.value.labels )
    const { label, description, default: defaultValues } = customize.settings.controls[ props.setting ]
    const [ responsive, setResponsive ] = useState('desktop')
    const { setTypographyPreset } = useDispatch( myCustomStore );

    useEffect(() => {
        if( ! presetLabels ) return
        let googleFontsUrl = 'https://fonts.googleapis.com/css2?'
        let googleFontsUrlQuery
        let linkTag
        if( ! document.getElementById( 'blogmatic-typography-presets-fonts' ) ) {
            linkTag = document.createElement('link')
            linkTag.rel = 'stylesheet'
            linkTag.id = 'blogmatic-typography-presets-fonts'
        } else {
            linkTag = document.getElementById( 'blogmatic-typography-presets-fonts' )
        }
        presetLabels.map(( current, index ) => {
            const { font_weight, font_family } = typoPresets[index]
            let count = index + 1
            let fontStyle = font_weight.variant === 'italic' ? 'ital,wght@' : 'wght@'
            if( count === 1 ) {
                googleFontsUrlQuery = 'family=' + font_family.value + ':' + fontStyle + font_weight.value
            } else {
                googleFontsUrlQuery += '&family=' + font_family.value + ':' + fontStyle + font_weight.value
            }
        })
        linkTag.href = googleFontsUrl + googleFontsUrlQuery
        document.head.appendChild( linkTag );
        setTypographyPreset({ typographies: typoPresets, labels: presetLabels })
        customize.value( props.setting )({ typographies: typoPresets, labels: presetLabels })
    }, [ typoPresets, presetLabels ])

    /**
     * Update the typography state
     * 
     * @since 1.0.0
     */
    const updateTypographyState = ( property, val, reset = false, presetIndex = null ) => {
        const responsiveProperties = [ 'font_size', 'line_height', 'letter_spacing' ]
        let updatedTypography = {}
        if( responsiveProperties.includes( property ) && ! reset ) {
            updatedTypography = { ...typoPresets, [presetIndex]: { ...typoPresets[presetIndex], [property]: { ...typoPresets[presetIndex][property], [responsive]: val} } }
        } else {
            updatedTypography = { ...typoPresets, [presetIndex]: { ...typoPresets[presetIndex], [property]: val } }
        }
        setTypoPresets( Object.values( updatedTypography ) )
    }

    /**
     * update number of palettes
     * 
     * @since 1.0.0
     */
    const updateTypoPresetsCount = () => {
        setTypoPresets([ ...typoPresets, typoPresets[ typoPresets.length - 1 ] ])
        setPresetLabels([ ...presetLabels, presetLabels[ presetLabels.length - 1 ] ])
    }

    /**
     * Remove the preset
     * 
     * @since 1.0.0
     */
    const removePreset = ( index ) => {
        setTypoPresets( typoPresets.filter(( current, item ) => { return index != item }) )
        setPresetLabels( presetLabels.filter(( current, item ) => { return index != item }) )
    }

    /**
     * Reset the value to their default states
     * 
     * @since 1.0.0
     */
    const toDefault = () => {
        setTypoPresets( defaultValues.typographies )
        setPresetLabels( defaultValues.labels )
    }

    /**
     * Reset values to default
     * 
     * @since 1.0.0
     */
    const resetToDefault = ( index ) => {
        setTypoPresets([ ...typoPresets.slice( 0, index ), defaultValues.typographies[index], ...typoPresets.slice( index + 1 ) ])
        setPresetLabels([ ...presetLabels.slice( 0, index ), defaultValues.labels[index], ...presetLabels.slice( index + 1 ) ])
    }

    return (
        <>
            <BlogmaticControlHeader label={ label } description={ description }>
                <Dashicon icon='image-rotate' className="reset-button" onClick={() => toDefault()}/>
            </BlogmaticControlHeader>
            <div className="field-wrap">
                {
                    typoPresets.map(( preset, index ) => {
                        return (
                            <div className="typography-wrapper">
                               <div className="typography-inner-wrap">
                                <div class="typo-field">
                                        <TextControl
                                            value = { presetLabels[index] }
                                            onChange = {( newLabel ) => setPresetLabels([ ...presetLabels.slice( 0, index ), newLabel, ...presetLabels.slice( index + 1 ) ]) }
                                        />
                                    </div>
                                    <div className="typography-item">
                                        <div className="trash-reset-wrapper">
                                            { ( typoPresets.length > 1 ) && <Dashicon
                                                className = "remove-from-list"
                                                icon = "trash"
                                                onClick = {() => removePreset( index )}
                                            /> }
                                            <Dashicon className="reset-button components-button is-secondary is-small" icon="image-rotate" onClick={() => resetToDefault( index )} />
                                        </div>
                                        <TypographyComponent
                                            key = { index }
                                            value = { preset }
                                            updateTypography = { updateTypographyState }
                                            defaultValue = { defaultValues.typographies[index] }
                                            setResponsive = { setResponsive }
                                            responsive = { responsive }
                                            isPreset = { true }
                                            presetIndex = { index }
                                        />
                                    </div>
                               </div>
                            </div>
                        )
                    })
                }
            </div>
            <TextControl
                type = 'hidden'
                id = { props.setting + '-reflector' }
                value = { typoPresets.length }
            />
            <Button
                className = "add-to-list" 
                variant = "primary"
                text = { __( 'Add', 'blogmatic-pro' ) }
                isSmall = { true }
                icon = 'plus'
                onClick = {() => updateTypoPresetsCount()}
            />
        </>
    );
}